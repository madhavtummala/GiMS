#!/usr/local/bin/python3 

import os
import pdfrw
import sys


ANNOT_KEY = '/Annots'
ANNOT_FIELD_KEY = '/T'
ANNOT_VAL_KEY = '/V'
ANNOT_RECT_KEY = '/Rect'
SUBTYPE_KEY = '/Subtype'
WIDGET_SUBTYPE_KEY = '/Widget'


def write_fillable_pdf(input_pdf_path, output_pdf_path, data_dict):
	template_pdf = pdfrw.PdfReader(input_pdf_path)
	template_pdf.Root.AcroForm.update(pdfrw.PdfDict(NeedAppearances=pdfrw.PdfObject('true')))
	annotations = template_pdf.pages[0][ANNOT_KEY]
	#print(annotations)
	for annotation in annotations:
		if annotation[SUBTYPE_KEY] == WIDGET_SUBTYPE_KEY:
			if annotation[ANNOT_FIELD_KEY]:
				key = annotation[ANNOT_FIELD_KEY][1:-1]
				#print(key)
				if key in data_dict.keys():
					annotation.update(
						pdfrw.PdfDict(AP=data_dict[key], V=data_dict[key])
					)
	pdfrw.PdfWriter().write(output_pdf_path, template_pdf)


data_dict = {
'dummy': 'key'
}

if __name__ == '__main__':

	a = sys.argv[1].split(",")
	x = len(a)
	prefix = 'untitled'
	seq = 1
	for val in range(0, x-3):
		key = prefix + str(seq)
		data_dict[key] = a[val]
		seq = seq + 1

	if x > 2:
		FORM_ID = a[x-3]
		FORM_TYPE = a[x-2]
		BASE = a[x-1]

	INVOICE_TEMPLATE_PATH = '{}/templates/{}.pdf'.format(BASE,FORM_TYPE)
	INVOICE_OUTPUT_PATH = '{}/forms/{}.pdf'.format(BASE,FORM_ID)

	write_fillable_pdf(INVOICE_TEMPLATE_PATH, INVOICE_OUTPUT_PATH, data_dict)