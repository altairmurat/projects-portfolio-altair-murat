import telebot
import time
from telebot import types
import sqlite3

bot = telebot.TeleBot('8020466401:AAGYymV2PhD25JU-MFf4wqx2HkYPNfbE1Ig')

channel_id = '@upswithaltair'
                      
@bot.message_handler(commands=['start'])
def main(message):
    username = message.from_user.username
    
    conn = sqlite3.connect('satf4.sql')
    cur = conn.cursor()
    
    cur.execute('CREATE TABLE IF NOT EXISTS users (id int auto_increment primary key, username varchar(50))')
    cur.execute('INSERT INTO users (username) VALUES ("%s")' % (username))
    
    conn.commit()
    cur.close()
    conn.close()
    
    markup = types.InlineKeyboardMarkup()
    bt1 = types.InlineKeyboardButton('Узнать подробнее про марафон', url='https://t.me/upswithaltair/388')
    markup.row(bt1)
    bt2 = types.InlineKeyboardButton('Регистрация на марафон', callback_data="reg")
    markup.row(bt2)
    bot.send_message(message.chat.id, f"Привет! {message.from_user.first_name}, это бот для регистрации на <b>БЕСПЛАТНЫЙ марафон по подготвке к SAT May 2025</b>", reply_markup=markup, parse_mode='html')

@bot.callback_query_handler(func=lambda callback: True)
def callback_reg(callback):
    if callback.data == "reg":
        markup = types.InlineKeyboardMarkup()
        bt1 = types.InlineKeyboardButton('1) Подписаться на altf4', url='https://t.me/upswithaltair')
        bt2 = types.InlineKeyboardButton('2) Сделать репост в сториз', url='https://t.me/upswithaltair/388')
        markup.row(bt1, bt2)
        bt3 = types.InlineKeyboardButton('Как сделать репост в сториз в тг?', url='https://postium.ru/repost-posta-v-istoriyu-telegram/')
        markup.row(bt3)
        bot.send_message(callback.message.chat.id, 'Для регистрации, вам необходимо выполнить два условия и <b>скинуть скриншот их выполнения</b>: (1) подписаться на канал altf4 и (2) сделать репост марафона в сториз. <b>Как только скинете скришот</b>, бот скинет вам ссылку на марафон', reply_markup=markup, parse_mode='html')

@bot.message_handler(content_types=['photo'])
def get_photo(message):
    user_id = message.from_user.id  
    try:
        chat_member = bot.get_chat_member(channel_id, user_id)
        if chat_member.status in ["member", "administrator", "creator"]: 
            bot.send_message(message.chat.id, 'Отлично! мы проверим, выполнили ли вы все условия марафона и скинем вам ссылку на наш марафон в скором времени.')
            time.sleep(600)
            markup = types.InlineKeyboardMarkup()
            bt1 = types.InlineKeyboardButton('Зайти на марафон', url='https://t.me/+GRZEH8Sj5ho2NmMy') 
            markup.row(bt1)
            bot.reply_to(message, "Вы успешно прошли проверку. Можете зайти в группу марафона по кнопке ниже", reply_markup=markup)
        else:
            bot.reply_to(message, "Вы либо не сделали репост в сториз, либо не подписаны на канал. Пожалуйста, выполните условия!")
    except Exception as e:
        bot.reply_to(message, f"Ошибка: {str(e)}")
        print(f"Error checking subscription: {e}")
    
bot.polling(none_stop=True)