from flask import Flask, request, Response, redirect, url_for, jsonify, render_template
from models.connection import db

from models.locker import Locker
from models.place import Place
from models.type import Type

from controllers.manager import Manager

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

@app.route('/manager/locker', methods=['GET', 'POST', 'PUT', 'DELETE'])
def admin_locker():
    # TODO comprobar que el usuario está autenticado como manager
    manager = Manager
    if request.method == 'POST':
        try:
            if request.args.get('create') == 'locker':
                return manager.locker_create()
            elif request.args.get('create') == 'place':
                return manager.place_create()
            elif request.args.get('create') == 'type':
                return manager.type_create()
            else:
                return jsonify({'error': 'No se ha especificado un objeto válido'}), 400
        except Exception:
            return jsonify({'error': 'Se debe especificar en la url qué objeto se quiere crear'}), 400
    elif request.method == 'GET':
        return manager.lockers_list()
    elif request.method == 'DELETE':
        return manager.locker_delete()



if __name__ == '__main__':
    app.run()