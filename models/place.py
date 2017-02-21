from .connection import db


class Place(db.model):
    """docstring for ClassName"""
    id = db.Column(db.Integer, primary_key=True, autoincrement=1)
    building = db.Column(db.String(50), nullable=False)
    zone = db.Column(db.String(50), nullable=False)
    floor = db.Column(db.Integer, nullable=False)
    school = db.Column(db.Integer, nullable=False)

    locker_id = db.Column(db.Integer, db.ForeignKey('locker.id'))


    def __init__(self, building, zone, floor, school):
         self.building = building
         self.zone = zone
         self.floor = floor
         self.school = school

    def __repr__(self):
        return{
            'id': self.id,
            'building': self.building,
            'zone': self.zone,
            'floor': self.floor,
            'school':self.school

        }