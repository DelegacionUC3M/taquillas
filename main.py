from flask import Flask, request, Response, redirect, url_for, jsonify, render_template, make_response
from models.connection import db
from fpdf import FPDF
from models.PDF import *
from baimen.decorators import *

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

# TODO hacer pruebas sobre la autorizacion y la comprobacion de rol de usuario

@authorization_required
@check_role('manager')
@app.route('/manager/locker', methods=['GET', 'POST'])
def manager_locker():
    manager = Manager
    if request.method == 'POST':
        return manager.locker_create()
    elif request.method == 'GET':
        return manager.lockers_list()


@authorization_required
@check_role('manager')
@app.route('/manager/locker/<int:id>', methods=['GET', 'PUT', 'DELETE'])
def manager_locker_id(id):
    manager = Manager
    if request.method == 'DELETE':
        return manager.locker_delete(id)
    elif request.method == 'GET':
        return manager.locker_list(id)
    elif request.method == 'PUT':
        return manager.locker_modify(id)


@authorization_required
@check_role('manager')
@app.route('/manager/place', methods=['POST'])
def manager_place():
    manager = Manager
    if request.method == 'POST':
        return manager.place_create()


@authorization_required
@check_role('manager')
@app.route('/manager/place/<int:id>', methods=['PUT', 'DELETE'])
def manager_place_id(id):
    manager = Manager
    if request.method == 'DELETE':
        return manager.place_delete(id)
    elif request.method == 'PUT':
        return manager.place_modify(id)


@authorization_required
@check_role('manager')
@app.route('/manager/type', methods=['POST'])
def manager_type():
    manager = Manager
    if request.method == 'POST':
        return manager.type_create()


@authorization_required
@check_role('manager')
@app.route('/manager/type/<int:id>', methods=['PUT', 'DELETE'])
def manager_type_id(id):
    manager = Manager
    if request.method == 'DELETE':
        return manager.type_delete(id)
    elif request.method == 'PUT':
        return manager.type_modify(id)


@authorization_required
@check_role('admin')
@app.route('/admin/locker', methods=['GET'])
def admin_locker():
    admin = Admin
    if request.method == 'GET':
        return admin.lockers_list()


@authorization_required
@check_role('admin')
@app.route('/admin/locker/<int:id>', methods=['GET', 'PUT'])
def admin_locker_id(id):
    admin = Admin
    if request.method == 'GET':
        return admin.locker_list(id)
    elif request.method == 'PUT':
        return admin.locker_modify(id)


@authorization_required
@app.route('/locker/<int:id>', methods=['PUT'])
def user_locker_id(id):
    user = User
    if request.method == 'PUT':
        return user.locker_modify(id)


@app.route('/locker', methods=['GET'])
def public_locker_list():
    public = Public
    if request.method == 'GET':
        return public.lockers_list()


@app.route('/locker/<int:id>', methods=['GET'])
def public_locker_id(id):
    public = Public
    if request.method == 'GET':
        return public.locker_list(id)


@app.route('/locker/qr/<int:qr>', methods=['GET'])
def public_locker_qr(qr):
    public = Public
    if request.method == 'GET':
        return public.locker_list_qr(qr)


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
        return public.types_list()


@app.route('/type/<int:id>', methods=['GET'])
def public_type_id(id):
    public = Public
    if request.method == 'GET':
        return public.type_list(id)


if __name__ == '__main__':
    app.run()
