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
        # TODO Llamar desde /locker/<id> y pasar el <id> a la función
        # TODO Sin terminar ni probar
        locker_db = Locker.query.filter_by(id=locker_id)
        db.session.delete(locker_db)
        db.session.commit()

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


from main import *