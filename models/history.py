from .connection import db


class History(db.Model):
    id = db.Column(db.Integer, primary_key=True, autoincrement=True)
    number = db.Column(db.Integer, nullable=False)
    status = db.Column(db.Integer, nullable=False)
    qr = db.Column(db.Integer, nullable=False)
    type_name = db.Column(db.String(20), nullable=False)
    type_price = db.Column(db.Integer, nullable=False)
    place_building = db.Column(db.String(50), nullable=False)
    place_zone = db.Column(db.String(50), nullable=False)
    place_floor = db.Column(db.Integer, nullable=False)
    place_school = db.Column(db.Integer, nullable=False)
    user = db.Column(db.Integer, nullable=True)
    date = db.Column(db.Date, nullable=True)

    def __init__(self, number, status, qr, type_name, type_price, place_building,
                 place_zone, place_floor, place_school, user, date):
        self.number = number
        self.status = status
        self.qr = qr
        self.type_name = type_name
        self.type_price = type_price
        self.place_building = place_building
        self.place_zone = place_zone
        self.place_floor = place_floor
        self.place_school = place_school
        self.user = user
        self.date = date

    def __repr__(self):
        return str({
            'id': self.id,
            'number': self.number,
            'status': self.status,
            'qr': self.qr,
            'type_name': self.type_name,
            'type_price': self.type_price,
            'place_building': self.place_building,
            'place_zone': self.place_zone,
            'place_floor': self.place_floor,
            'place_school': self.place_school,
            'user': self.user,
            'date': self.date
        })