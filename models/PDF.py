class PDF:

    @staticmethod
    def lockerlistpdf(query_result, places):
        pdf = FPDF()
        pdf.add_page()
        pdf.set_font('Arial', 'B', 16)
        pdf.cell(60)
        pdf.cell(60, 10, 'Listado de taquillas', 1, 0, 'C')
        pdf.ln(15)
        for place in places:
            pdf.set_font('Arial', 'B', 11)
            pdf.ln(15)
            pdf.multi_cell(0, 10, place.pdfrepr(), 0, 1)
            pdf.ln(1)
            pdf.set_x(15)
            pdf.cell(60, 10, 'Numero', 0, 0)
            pdf.cell(10, 10, '', 0, 0)
            pdf.cell(60, 10, 'Estado', 0, 0)
            pdf.cell(10, 10, '', 0, 0)
            pdf.cell(60, 10, 'Tipo', 0, 0)
            pdf.ln(1)
            for locker in query_result:
                if locker.place == place.id:
                    pdf.set_font('Arial', '', 10)
                    pdf.ln(5)
                    pdf.set_x(15)
                    pdf.cell(60, 10, str(locker.number), 0)
                    pdf.cell(10, 10, '', 0, 0)
                    pdf.cell(60, 10, locker.getStatusFromStatusNumber(), 0, 0)
                    pdf.cell(10, 10, '', 0, 0)
                    pdf.cell(60, 10, locker.getTypeFromTypeNumber(), 0, 0)

        response = make_response(pdf.output(dest='S').encode('latin-1'))
        response.headers.set('Content-Disposition', 'attachment', filename="Hello" + '.pdf')
        response.headers.set('Content-Type', 'application/pdf')
        return response

from main import *