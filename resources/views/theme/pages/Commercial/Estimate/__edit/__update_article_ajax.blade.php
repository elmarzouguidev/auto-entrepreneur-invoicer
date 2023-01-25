<script>
    $(".updateArticleRecord").click(function(event) {
        event.preventDefault();

        var result = confirm('Are you sure you want to update this record?');

        var articleuuid = $(this).data("articleuuid");
        var estimate = $(this).data("estimate");

        var designation = $(this).data("designation");
        var prix_unitaire = $(this).data("prix_unitaire");
        var montant_ht = $(this).data("montant_ht");
        var quantity = $(this).data("quantity");
        var remise = $(this).data("remise");

        var token = $("meta[name='csrf-token']").attr("content");

        if (result) {

            $.ajax({
                url: "{{ route('commercial:estimates.update.article') }}",
                type: 'DELETE',
                data: {
                    "articleuuid": articleuuid,
                    "estimate": estimate,

                    "designation": designation,
                    "prix_unitaire": prix_unitaire,
                    "montant_ht": montant_ht,
                    "quantity": quantity,
                    "remise": remise,
    
                    "_token": token,
                },
                success: function() {
                    console.log("it Works");
                    $( "#articles_list" ).load(window.location.href + " #articles_list" );
                    window.location.reload();
                }
            });
        }

    });
</script>
