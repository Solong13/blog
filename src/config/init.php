<?php

namespace SoLong\Blog\config;
class Config {
    const DB_HOST = 'localhost';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_DATABASE = 'blog';
    const MAINPATH = "messags.json";
    const USERDB = "user_db.json";
    const ABSOLUTPATH = $_SERVER['DOCUMENT_ROOT'];/*
    призначити значення константі ABSOLUTPATH на етапі визначення класу, але це 
    неможливо зробити прямо в оголошенні класу, оскільки $_SERVER['DOCUMENT_ROOT'] 
    є значенням, яке може бути визначено лише під час виконання скрипта.*/
    const HOST = 'http://blog/';

}