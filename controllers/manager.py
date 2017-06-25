class Manager:

    @staticmethod
    def locker_creator():
        try:
            locker_data = request.get_json()
            locker = Locker(locker_data['number'], 0, None, locker_data['type'], locker_data['place'], None, None)
            db.session.add(locker)
            db.session.commit()
            return jsonify({'success': 'Taquilla ' + str(locker_data['number']) + ' creada correctamente'}), 201
        except Exception:
            return jsonify({'error': 'Error al crear la taquilla'}), 500

    @staticmethod
    def place_creator():
        try:
            place_data = request.get_json()
            place = Place(place_data['building'], place_data['zone'], place_data['floor'], place_data['school'])
            db.session.add(place)
            db.session.commit()
            return jsonify({'success': 'Lugar creado correctamente'}), 201
        except Exception:
            return jsonify({'error': 'Error al crear el lugar'}), 500

    @staticmethod
    def type_creator():
        try:
            type_data = request.get_json()
            type_l = Type(type_data['name'], type_data['price'])
            db.session.add(type_l)
            db.session.commit()
            return jsonify({'success': 'Tipo '  + str(type_data['name']) + ' creado correctamente'}), 201
        except Exception:
            return jsonify({'error': 'Error al crear el lugar'}), 500

    @staticmethod
    def lockers_lister():
        query = Locker.query.all()
        if len(request.args.copy()) > 0:
            for key in request.args.values():
                try:
                    query.filter(key=request.args.values()[key])
                except Exception:
                    return 'Error' # TODO especificar error y poner codigo http
        return jsonify([locker.__repr__() for locker in query])


from main import *