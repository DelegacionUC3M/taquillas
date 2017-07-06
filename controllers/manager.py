class Manager:

    # TODO faltan por comprobar muchos errores

    @staticmethod
    def locker_create():
        try:
            locker_data = request.get_json()
            locker = Locker(locker_data['number'], 0, None, locker_data['type'], locker_data['place'], None, None)
            db.session.add(locker)
            db.session.commit()
            return jsonify({'success': 'Taquilla ' + str(locker_data['number']) + ' creada correctamente'}), 201
        except Exception:
            return jsonify({'error': 'Error al crear la taquilla.'}), 500

    @staticmethod
    def locker_delete(locker_id):
        try:
            locker_db = Locker.query.filter_by(id=locker_id)
            db.session.delete(locker_db[0])
            db.session.commit()
            return jsonify({'success': 'Taquilla eliminada'}), 200
        except Exception:
            return jsonify({'error': 'Error al eliminar'}), 500

    @staticmethod
    def locker_modify(locker_id):
        try:
            Locker.query.filter_by(id=locker_id).update(request.get_json())
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
            return jsonify({'error': 'Taquilla no valida'}), 500

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
                return jsonify({'error': 'Parametros de la url no validos'}), 400
        else:
            query_result = Locker.query.all()
        return jsonify([locker.__repr__() for locker in query_result])

    @staticmethod
    def place_create():
        try:
            place_data = request.get_json()
            place = Place(place_data['building'], place_data['zone'], place_data['floor'], place_data['school'])
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
            Place.query.filter_by(id=place_id).update(request.get_json())
            db.session.commit()
            return jsonify({'success': 'Lugar modificado'}), 200
        except Exception:
            return jsonify({'error': 'Error al modificar'}), 500

    @staticmethod
    def place_list(place_id):
        try:
            place_db = Place.query.filter_by(id=place_id)
            return jsonify(place_db[0].__repr__()), 200
        except Exception:
            return jsonify({'error': 'Lugar no válido'}), 500

    @staticmethod
    def places_list():
        params_multidic = request.args.copy()
        if len(params_multidic) > 0:
            params_dic = {}
            for e in params_multidic:
                params_dic[e] = params_multidic[e]
            try:
                query_result = Place.query.filter_by(**params_dic).all()
            except Exception:
                return jsonify({'error': 'Parametros de la url no validos'}), 400
        else:
            query_result = Place.query.all()
        return jsonify([place.__repr__() for place in query_result])

    @staticmethod
    def type_create():
        try:
            type_data = request.get_json()
            type_l = Type(type_data['name'], type_data['price'])
            db.session.add(type_l)
            db.session.commit()
            return jsonify({'success': 'Tipo '  + str(type_data['name']) + ' creado correctamente'}), 201
        except Exception:
            return jsonify({'error': 'Error al crear el lugar'}), 500

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
            Type.query.filter_by(id=type_id).update(request.get_json())
            db.session.commit()
            return jsonify({'success': 'Tipo modificado'}), 200
        except Exception:
            return jsonify({'error': 'Error al modificar'}), 500

    @staticmethod
    def type_list(type_id):
        try:
            type_db = Type.query.filter_by(id=type_id)
            return jsonify(type_db[0].__repr__()), 200
        except Exception:
            return jsonify({'error': 'Tipo no valido'}), 500

    @staticmethod
    def types_list():
        params_multidic = request.args.copy()
        if len(params_multidic) > 0:
            params_dic = {}
            for e in params_multidic:
                params_dic[e] = params_multidic[e]
            try:
                query_result = Type.query.filter_by(**params_dic).all()
            except Exception:
                return jsonify({'error': 'Parametros de la url no validos'}), 400
        else:
            query_result = Type.query.all()
        return jsonify([type.__repr__() for type in query_result])

from main import *