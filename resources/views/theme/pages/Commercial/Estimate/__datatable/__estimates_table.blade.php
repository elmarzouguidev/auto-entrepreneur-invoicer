@include('theme.pages.Commercial.Estimate.__datatable.__filter')

@include('theme.pages.Commercial.Estimate.__datatable.__with_options')

@each('theme.pages.Commercial.Estimate.__datatable.__send_estimate',$estimates ,'estimate' )

@each('theme.pages.Commercial.Estimate.__edit.__print_document',$estimates,'estimate')
