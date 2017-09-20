class Manager:

    @staticmethod
    def locker_create():
        try:
            locker_data = request.get_json()
            locker = Locker(locker_data['number'], locker_data['type'], locker_data['place'])
            locker_check = Locker.query.filter_by(number=locker.number, type=locker.type, place=locker.place)
            if locker_check[:]:
                return jsonify({'error': 'La taquilla ya existe'}), 500
            db.session.add(locker)
            db.session.commit()
            return jsonify({'success': 'Taquilla ' + str(locker_data['number']) + ' creada correctamente'}), 201
        except Exception:
            return jsonify({'error': 'Error al crear la taquilla'}), 500

    @staticmethod
    def locker_delete(locker_id):
        try:
            locker_db = Locker.query.filter_by(id=locker_id)
            if not locker_db[:]:
                return jsonify({'error': 'La taquilla no existe'}), 500
            db.session.delete(locker_db[0])
            db.session.commit()
            return jsonify({'success': 'Taquilla eliminada'}), 200
        except Exception:
            return jsonify({'error': 'Error al eliminar'}), 500

    @staticmethod
    def locker_modify(locker_id):
        try:
            locker_db = Locker.query.filter_by(id=locker_id)
            if not locker_db[:]:
                return jsonify({'error': 'La taquilla no existe'}), 500
            locker_db.update(request.get_json())
            db.session.commit()
            return jsonify({'success': 'Taquilla modificada'}), 200
        except Exception:
            return jsonify({'error': 'Error al modificar'}), 500

    @staticmethod
    def locker_list(locker_id):
        try:
            locker_db = Locker.query.filter_by(id=locker_id)
            return jsonify(locker_db[0].__repr__()), 200
        except Exception:
            return jsonify({'error': 'Taquilla no válida'}), 500

    @staticmethod
    def lockers_list():
        params_multidic = request.args.copy()
        if len(params_multidic) > 0:
            params_dic = {}
            for e in params_multidic:
                params_dic[e] = params_multidic[e]
            try:
                query_result = Locker.query.order_by(Locker.place).filter_by(**params_dic).all()
            except Exception:
                return jsonify({'error': 'Parámetros no válidos'}), 400
        else:
            query_result = Locker.query.all()
        return jsonify([locker.__repr__() for locker in query_result]), 200

    @staticmethod
    def place_create():
        try:
            place_data = request.get_json()
            place = Place(place_data['building'], place_data['zone'], place_data['floor'], place_data['school'])
            place_check = Place.query.filter_by(building=place.building, floor=place.floor, school=place.school, zone=place.zone)
            if place_check[:]:
                return jsonify({'error': 'El lugar ya existe'}), 500
            db.session.add(place)
            db.session.commit()
            return jsonify({'success': 'Lugar creado correctamente'}), 201
        except Exception:
            return jsonify({'error': 'Error al crear el lugar'}), 500

    @staticmethod
    def place_delete(place_id):
        try:
            place_db = Place.query.filter_by(id=place_id)
            db.session.delete(place_db[0])
            db.session.commit()
            return jsonify({'success': 'Lugar eliminado'}), 200
        except Exception:
            return jsonify({'error': 'Error al eliminar'}), 500

    @staticmethod
    def place_modify(place_id):
        try:
            place_db = Place.query.filter_by(id=place_id)
            if not place_db[:]:
                return jsonify({'error': 'El lugar no existe'}), 500
            place_db.update(request.get_json())
            db.session.commit()
            return jsonify({'success': 'Lugar modificado'}), 200
        except Exception:
            return jsonify({'error': 'Error al modificar'}), 500

    @staticmethod
    def type_create():
        try:
            type_data = request.get_json()
            type_l = Type(type_data['name'], type_data['price'])
            type_check = Type.query.filter_by(name=type_l.name)
            if type_check[:]:
                return jsonify({'error': 'El tipo ya existe'}), 500
            db.session.add(type_l)
            db.session.commit()
            return jsonify({'success': 'Tipo ' + str(type_data['name']) + ' creado correctamente'}), 201
        except Exception:
            return jsonify({'error': 'Error al crear el tipo'}), 500

    @staticmethod
    def type_delete(type_id):
        try:
            type_db = Type.query.filter_by(id=type_id)
            db.session.delete(type_db[0])
            db.session.commit()
            return jsonify({'success': 'Tipo eliminado' }), 200
        except Exception:
            return jsonify({'error': 'Error al eliminar'}), 500

    @staticmethod
    def type_modify(type_id):
        try:
            type_db = Type.query.filter_by(id=type_id)
            if not type_db[:]:
                return jsonify({'error': 'El tipo no existe'}), 500
            type_db.update(request.get_json())
            db.session.commit()
            return jsonify({'success': 'Tipo modificado'}), 200
        except Exception:
            return jsonify({'error': 'Error al modificar'}), 500

from main import *
