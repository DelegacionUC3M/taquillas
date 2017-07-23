from flask import Flask, request, Response, redirect, url_for, jsonify, render_template
from models.connection import db

from models.locker import Locker
from models.place import Place
from models.type import Type

from controllers.manager import Manager
from controllers.admin import Admin
from controllers.user import User
from controllers.public import Public

import requests
import json

# Inicializacion del objeto Flask
app = Flask(__name__)

# Generacion del dict (diccionario) de configuracion desde fichero
app.config.from_pyfile('config.cfg')

# Enlaza la aplicacion y la base de datos
db.app = app
db.init_app(app)
db.create_all()

# Url /
@app.route('/')
def index():
    return 'La api de taquillas está levantada'

@app.route('/manager/locker', methods=['GET', 'POST'])
def manager_locker():
    # TODO comprobar que el usuario está autenticado como manager
    manager = Manager
    if request.method == 'POST':
        return manager.locker_create()
    elif request.method == 'GET':
        return manager.lockers_list()

@app.route('/manager/locker/<int:id>', methods=['GET', 'PUT', 'DELETE'])
def manager_locker_id(id):
    # TODO comprobar que el usuario está autenticado como manager
    manager = Manager
    if request.method == 'DELETE':
        return manager.locker_delete(id)
    elif request.method == 'GET':
        return manager.locker_list(id)
    elif request.method == 'PUT':
        return manager.locker_modify(id)

@app.route('/manager/place', methods=['POST'])
def manager_place():
    # TODO comprobar que el usuario está autenticado como manager
    manager = Manager
    if request.method == 'POST':
        return manager.place_create()

@app.route('/manager/place/<int:id>', methods=['PUT', 'DELETE'])
def manager_place_id(id):
    # TODO comprobar que el usuario está autenticado como manager
    manager = Manager
    if request.method == 'DELETE':
        return manager.place_delete(id)
    elif request.method == 'PUT':
        return manager.place_modify(id)

@app.route('/manager/type', methods=['POST'])
def manager_type():
    # TODO comprobar que el usuario está autenticado como manager
    manager = Manager
    if request.method == 'POST':
        return manager.type_create()

@app.route('/manager/type/<int:id>', methods=['PUT', 'DELETE'])
def manager_type_id(id):
    # TODO comprobar que el usuario está autenticado como manager
    manager = Manager
    if request.method == 'DELETE':
        return manager.type_delete(id)
    elif request.method == 'PUT':
        return manager.type_modify(id)

@app.route('/admin/locker', methods=['GET'])
def admin_locker():
    # TODO comprobar que el usuario está autenticado como admin
    admin = Admin
    if request.method == 'GET':
        return admin.lockers_list()

@app.route('/admin/locker/<int:id>', methods=['GET', 'PUT'])
def admin_locker_id(id):
    # TODO comprobar que el usuario está autenticado como admin
    admin = Admin
    if request.method == 'GET':
        return admin.locker_list(id)
    elif request.method == 'PUT':
        return admin.locker_modify(id)

@app.route('/taquilla/<int:id>', methods=['PUT'])
def user_locker_id(id):
    #TODO comprobar que el usuario está autentucado
    user = User
    if request.method == 'PUT':
        return user.locker_modify(id)

@app.route('/taquilla/<int:id>', methods=['GET'])
def public_locker_id(id):
    public = Public
    if request.method == 'GET':
        return public.locker_list(id)

@app.route('/place', methods=['GET'])
def public_place():
    public = Public
    if request.method == 'GET':
        return public.places_list()

@app.route('/place/<int:id>', methods=['GET'])
def public_place_id(id):
    public = Public
    if request.method == 'GET':
        return public.place_list(id)

@app.route('/type', methods=['GET'])
def public_type():
    public = Public
    if request.method == 'GET':
        return public.type_list()

@app.route('/type/<int:id>', methods=['GET'])
def public_type_id(id):
    public = Public
    if request.method == 'GET':
        return public.type_list(id)

if __name__ == '__main__':
    app.run()