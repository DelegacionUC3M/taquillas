import time

class Admin:

    @staticmethod
    def locker_list(locker_id):
        try:
            locker_db = Locker.query.filter_by(id=locker_id)
            return jsonify(locker_db[0].__repr__()), 200
        except Exception:
            return jsonify({'error': 'Taquilla no válida'}), 404

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
        return jsonify([locker.__repr__() for locker in query_result])

    @staticmethod
    def locker_modify(locker_id):
        try:
            locker_data = request.get_json()
            locker = Locker.query.filter_by(id=locker_id)[0]

            if 'status' in locker_data and 'user' in locker_data:
                if locker_data['status'] == '1' and locker.status == 0:
                    locker.status = 1
                    locker.user = locker_data['user']
                    locker.date = time.strftime("%Y/%m/%d")
                    db.session.commit()
                    return jsonify({'success': 'Taquilla reservada'}), 200

                # TODO el admin debe poder modificar el usuario que ha reservado una taquilla?
                # En todo caso deberíamos dar un error si se ponen los mismos datos?
                elif locker_data['status'] == '1' and locker.status == 1:
                    return jsonify({'error': 'Esta taquilla ya está reservada'}), 500
                elif locker_data['status'] == '2':
                    locker.status = 2
                    locker.user = locker_data['user']
                    if locker.date is None:
                        locker.date = time.strftime("%Y/%m/%d")
                    db.session.commit()
                    return jsonify({'success': 'Taquilla cobrada'}), 200
            elif 'status' in locker_data:
                if locker_data['status'] == '0':
                    locker.status = 0
                    locker.user = None
                    locker.date = None
                    db.session.commit()
                    return jsonify({'success': 'Taquilla liberada'}), 200
            elif 'incidence' in locker_data:
                locker.incidence = locker_data['incidence']
                db.session.commit()
                return jsonify({'success': 'Incidencia modificada'}), 200
            #TODO admin puede cambiar QR?
            elif 'qr' in locker_data:
                locker.qr = locker_data['qr']
                db.session.commit()
                return jsonify({'success': 'QR modificado'}), 200
            else:
                return jsonify({'error': 'Modificación no válida'}), 500
        except Exception:
            return jsonify({'error': 'Error al modificar'}), 500

from main import *