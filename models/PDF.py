class PDF:

    @staticmethod
    def makepdf(query_result):
        pdf = FPDF()
        pdf.add_page()
        pdf.set_font('Arial', 'B', 16)
        pdf.cell(60)
        pdf.cell(60, 10, 'Listado de taquillas', 1, 0, 'C')
        pdf.ln(15)
        pdf.set_font('Arial', '', 11)
        for locker in query_result:
            pdf.ln(5)
            pdf.multi_cell(0, 10, locker.pdfrepr(), 0, 1)
        response = make_response(pdf.output(dest='S').encode('latin-1'))
        response.headers.set('Content-Disposition', 'attachment', filename="Hello" + '.pdf')
        response.headers.set('Content-Type', 'application/pdf')
        return response

from main import *