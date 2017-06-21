from flask import Flask, request, Response, redirect, url_for, jsonify, render_template
from models.connection import db

from models.locker import Locker
from models.place import Place
from models.type import Type

import requests
import json

# Inicializacion del objeto Flask
app = Flask(__name__)

# Generacion del dict (diccionario) de configuracion desde fichero
app.config.from_pyfile('config.cfg')

# Enlaza la aplicacion y la base de datos
db.app = app
db.init_app(app)

# Url /
@app.route('/')
def index():
    return 'Hola mundo'

'''
    Endpoints
'''

@app.route('/manager/taquillas', methods=['GET', 'POST', 'PUT', 'DELETE'])
def locker():
    if request.method == 'POST':
        resultado = locker_create()
    elif request.method == 'GET':
        resultado = locker_get()

    return resultado

'''
    Métodos
'''

# Crea una taquilla
def locker_create():
    place = Place.query.filter_by(school=request.form['school']) \
        .filter_by(building=request.form['building']) \
        .filter_by(floor=request.form['floor']) \
        .filter_by(zone=request.form['zone']).all()
    if len(place) != 0:
        try:
            locker = Locker(request.form['number'], 1, None, request.form['type'], place[0].id, None, None)
            db.session.add(locker)
            db.session.commit()
            return jsonify({'success': 'Taquilla ' + str(request.form['number']) + ' guardada correctamente'}), 201
        except:
            return jsonify({'error': 'Error al guardar la taquilla'}), 500
    else:
        return jsonify({'error': 'Localización no válida'}), 400

# Devuelve las taquillas de la base de datos
# TODO igual esto no se puede dejar así como api-rest
def locker_get():
    schools = Place.query.with_entities(Place.school).all()
    list_school = []
    for school in schools:
        if school.school not in list_school:
            list_school.append(school.school)
    dict_school = {}
    for school in list_school:
        json_school = requests.get('https://delegacion.uc3m.es/deleapi/school/' + str(school)).content
        dict_school[school] = json.loads(json_school)['name']

    buildings = Place.query.with_entities(Place.building).all()
    list_building = []
    for building in buildings:
        if building.building not in list_building:
            list_building.append(building.building)

    floors = Place.query.with_entities(Place.floor).all()
    list_floor = []
    for floor in floors:
        if floor.floor not in list_floor:
            list_floor.append(floor.floor)

    zones = Place.query.with_entities(Place.zone).all()
    list_zone = []
    for zone in zones:
        if zone.zone not in list_zone:
            list_zone.append(zone.zone)

    types = Type.query.all()

    return render_template('manager/locker_create.html', list_school=dict_school,
                           list_building=list_building, list_floor=list_floor,
                           list_zone=list_zone, types=types)