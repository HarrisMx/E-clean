#!/usr/bin/env python
# -*- coding: utf-8 -*-
#E-Clean Bot designed by BrainHack Devs

from telegram import (ReplyKeyboardMarkup, ReplyKeyboardRemove)
from telegram.ext import (Updater, CommandHandler, MessageHandler, Filters, RegexHandler,
                          ConversationHandler)

import logging
from telegram import InlineKeyboardButton, InlineKeyboardMarkup
from telegram.ext import Updater, CommandHandler, CallbackQueryHandler
import sys
import time
import random
import datetime
import json  
import requests
import firebase_admin
from firebase_admin import credentials
from firebase_admin import db
from firebase_admin import storage

userName = ' '
userPin = ' '
user_location = None
msg = ' ' 

logging.basicConfig(format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
                    level=logging.INFO)

logger = logging.getLogger(__name__)

USER_CRED, COMMENT, SECTORS, SECTOR_COMP, PHOTO, LOCATION = range(6)


def start(bot, update):
    keyboard = [[InlineKeyboardButton("Report", callback_data='report'),
                 InlineKeyboardButton("Compliment", callback_data='compliment')]]

    reply_markup = InlineKeyboardMarkup(keyboard)

    update.message.reply_text('Hi! I am E-Clean Bot. How can I be at your service. '
                               'Send /cancel to stop session.\n\n' 
							   ' Please choose:', reply_markup=reply_markup)

    return USER_CRED

def user_cred(bot, update):
    query = update.callback_query
	
    if query.data == 'report':
        bot.edit_message_text(text="Use /comment to report an incident",
                          chat_id=query.message.chat_id,
                          message_id=query.message.message_id)
        return COMMENT
          
    elif query.data == 'compliment':
        bot.edit_message_text(text="Thanks for choosing this option. Use /sectors to navigate different sectors",
                          chat_id=query.message.chat_id,
                          message_id=query.message.message_id)
        return SECTORS
def get_sectors(bot, update):
    keyboard = [[InlineKeyboardButton("Waste Removal", callback_data='waste'),
                 InlineKeyboardButton("Pothole Management", callback_data='pothole')]]

    reply_markup = InlineKeyboardMarkup(keyboard)

    update.message.reply_text('Choose the following sectors to compliment:', reply_markup=reply_markup)

    return SECTOR_COMP

def compliment(bot, update):
    query = update.callback_query

    if query.data == 'waste':
        bot.edit_message_text(text="Waste Removal choosen. Let's proceed, use /comment to comppliment an incident",
                          chat_id=query.message.chat_id,
                          message_id=query.message.message_id)
        return COMMENT
    
    elif query.data == 'pothole':
         bot.edit_message_text(text="Pothole management choosen. Let's proceed, use /comment to comppliment an incident",
                          chat_id=query.message.chat_id,
                          message_id=query.message.message_id)
         return COMMENT
        

def comment(bot, update):
    update.message.reply_text('You more than welcome to take a picture or leave a note. Use /done to end session')
    return PHOTO
	   
def photo(bot, update):
    photo_file = bot.get_file(update.message.photo[-1].file_id)
    photo_file.download('user_photo.jpg')

    user_photo = '~/hackathon/telegram_app/E-Clean'

    update.message.reply_text('Awesome! I got the picture.  Now send me your location.')
    
    return LOCATION

    
def notes(bot, update):
    global msg
    msg = update.message.text
    update.message.reply_text('Awesome! I got the note. Now send me your location.')
    
    return LOCATION

def location(bot, update):
    global latitude
    global longitude
    latitude = update.message.location.latitude
    longitude = update.message.location.longitude

    update.message.reply_text('Awesome! Now I know where the picture or note is taken.')

    comment(bot, update)    

def done(bot, update):
    update.message.reply_text('Thank you! :) .')
    
    database_config()
    start(bot, update)
    
def cancel(bot, update):
    update.message.reply_text('Bye! You cancelled the session',
                              reply_markup=ReplyKeyboardRemove())

    return ConversationHandler.END


def error(bot, update, error):
    logger.warning('Update "%s" caused error "%s"', update, error)

def database_config():
    cred = credentials.Certificate('ehealth-cabd5-firebase-adminsdk-9199u-1d7c6c0a87.json')
    default_app = firebase_admin.initialize_app(cred, {'databaseURL':'https://ehealth-cabd5.firebaseio.com'})

    ref = db.reference('tickets/')
    ref.child('complain').child('3').child('location').child('latitude').set(latitude)
    ref.child('complain').child('3').child('location').child('longitude').set(longitude)
    ref.child('complain').child('3').child('message').set(msg)

    ref = db.reference('tickets/')
    ref.child('compliments').child('2').child('location').child('latitude').set(latitude)
    ref.child('compliments').child('2').child('location').child('longitude').set(longitude)
    ref.child('compliments').child('2').child('message').set(msg)

def main():
   
    updater = Updater("599717950:AAHo0VpZ-zLkk278w4AOsZFRF3P9unA7M1k")

    dp = updater.dispatcher

    
    conv_handler = ConversationHandler(
        entry_points=[CommandHandler('start', start)],
                       

        states={
            USER_CRED: [CallbackQueryHandler(user_cred)],
                        
            COMMENT: [CommandHandler('comment', comment)],
			
            PHOTO: [MessageHandler(Filters.photo, photo),
                    MessageHandler(Filters.text, notes)],
                    
            SECTOR_COMP: [CallbackQueryHandler(compliment)],
            
            SECTORS: [CommandHandler('sectors', get_sectors)],

            LOCATION: [MessageHandler(Filters.location, location),
                       CommandHandler('done', done)]
			
        },

        fallbacks=[CommandHandler('cancel', cancel)]
    )

    dp.add_handler(conv_handler)

    dp.add_error_handler(error)

    updater.start_polling()

    updater.idle()


if __name__ == '__main__':
    main()