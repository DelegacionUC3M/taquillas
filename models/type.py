from .connection import db


class Type(db.Model):  # hereda del objeto model
    """docstring for ClassName"""
    id = db.Column(db.Integer, primary_key=True, autoincrement=True)
    name = db.Column(db.String, nullable=False)
    price = db.Column(db.Float, nullable=False)
    lockers = db.relationship('Locker', lazy='dynamic')


    # si tiene cursiva puede ser null


    def __init__(self, name, price):
        self.name = name
        self.price = price


    def __repr__(self):
        return str({
            'id': self.id,
            'name': self.name,
            'price': self.price
        })