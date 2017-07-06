import time

class Admin:

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
    def locker_modify(locker_id):
        try:
            locker_data = request.get_json()
            locker = Locker.query.filter_by(id=locker_id)[0]

            if locker_data['status'] == '2' and locker_data['user']:
                locker.status = 2
                locker.user = locker_data['user']
                if locker.date is None:
                    locker.date = time.strftime("%Y/%m/%d")
                db.session.commit()
                return jsonify({'success': 'Taquilla cobrada'}), 200
            elif locker_data['status'] == '0':
                locker.status = 0
                locker.user = None
                locker.date = None
                db.session.commit()
                return jsonify({'success': 'Taquilla liberada'}), 200
            #TODO crear columna para incidencia
            #elif locker_data['incidencia']:
            #    locker.incidencia = locker_data['incidencia']
            #    db.session.commit()
            #    return jsonify({'success': 'Incidencia modificada'}), 200
            #TODO admin puede cambiar QR?
            elif locker_data['qr']:
                locker.qr = locker_data['qr']
                db.session.commit()
                return jsonify({'success': 'QR modificado'}), 200
            else:
                return jsonify({'error': 'Modificación no válida'}), 500
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