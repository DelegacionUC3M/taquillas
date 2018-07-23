class Public:

    @staticmethod
    def lockers_list():
        params_multidic = request.args.copy()
        if len(params_multidic) > 0:
            params_dic = {}
            for e in params_multidic:
                params_dic[e] = params_multidic[e]
            try:
                query_result = Locker.query.join(Place).filter(Locker.place == Place.id).order_by(Place.building, Place.floor, Place.zone, Locker.number).filter_by(**params_dic).all()
            except Exception:
                return jsonify({'error': 'Parámetros no válidos'}), 400
        else:
            query_result = Locker.query.join(Place).filter(Locker.place == Place.id).order_by(Place.building, Place.floor, Place.zone, Locker.number).all()
        return jsonify([locker.publicrepr() for locker in query_result]), 200

    @staticmethod
    def locker_list(locker_id):
        try:
            locker_db = Locker.query.filter_by(id=locker_id)[0]
            return jsonify({'status': locker_db.status, 'type': locker_db.type}), 200
        except Exception:
            return jsonify({'error': 'Taquilla no válida'}), 404

    @staticmethod
    def locker_list_qr(locker_qr):
        try:
            locker_db = Locker.query.filter_by(qr=locker_qr)[0]
            return jsonify({'id': locker_db.id,'status': locker_db.status, 'type': locker_db.type}), 200
        except Exception:
            return jsonify({'error': 'QR no válido'}), 404

    @staticmethod
    def place_list(place_id):
        try:
            place_db = Place.query.filter_by(id=place_id)
            return jsonify(place_db[0].__repr__()), 200
        except Exception:
            return jsonify({'error': 'Lugar no válido'}), 404

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
                return jsonify({'error': 'Parámetros no válidos'}), 400
        else:
            query_result = Place.query.all()
        
        datosJson = '['
        bol = 0

        for place in query_result:
            if bol != 0:
                datosJson += ','
            else:
                bol = 1

            datosJson += json.dumps({"id": place.id, "building": place.building, "zone": place.zone, "floor":place.floor, "school":place.school}, ensure_ascii=False)
             
        datosJson = datosJson.replace("}{", ", ")
        datosJson = datosJson.replace("},,{", "},{")
        datosJson += ']'
        datosJson = datosJson.replace("},]", "}]")
        datosJson = datosJson.replace(",,]", "]")
        
        return Response(datosJson, mimetype='application/json'), 200

    @staticmethod
    def type_list(type_id):
        try:
            type_db = Type.query.filter_by(id=type_id)
            return jsonify(type_db[0].__repr__()), 200
        except Exception:
            return jsonify({'error': 'Tipo no válido'}), 404

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
                return jsonify({'error': 'Parámetros no válidos'}), 400
        else:
            query_result = Type.query.all()

        datosJson = '['
        bol = 0

        for type in query_result:
            if bol != 0:
                datosJson += ','
            else:
                bol = 1

            datosJson += json.dumps({"id": type.id, "price": type.price, "name": type.name}, ensure_ascii=False)
             
        datosJson = datosJson.replace("}{", ", ")
        datosJson = datosJson.replace("},,{", "},{")
        datosJson += ']'
        datosJson = datosJson.replace("},]", "}]")
        datosJson = datosJson.replace(",,]", "]")
        
        return Response(datosJson, mimetype='application/json'), 200

from main import *
