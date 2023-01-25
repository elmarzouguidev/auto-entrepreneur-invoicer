@include('theme.pages.Commercial.InvoiceAvoir.__datatable.__filters')

@include('theme.pages.Commercial.InvoiceAvoir.__datatable.__with_options')

{{-- @include('theme.pages.Commercial.Invoice.__datatable.__payment_detail_modal') --}}

@each('theme.pages.Commercial.InvoiceAvoir.__datatable.__payment_detail_modal', $invoices, 'invoice')

@each('theme.pages.Commercial.InvoiceAvoir.__edit.__print_document', $invoices, 'invoice')

@each('theme.pages.Commercial.InvoiceAvoir.__datatable.__send_invoice_avoir', $invoices, 'invoice')
