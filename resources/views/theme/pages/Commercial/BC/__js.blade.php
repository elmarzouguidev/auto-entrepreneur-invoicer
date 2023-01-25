<script>
    function getChecked(checkboxName) {
        let checkBoxes = document.getElementsByName(checkboxName);
        let ids = Array.prototype.slice.call(checkBoxes)
            .filter(ch => ch.checked == true)
            .map(ch => ch.value);
        return ids;
    }

    function getSelected() {
        let client = $('#clienter').select2('data');
        // console.log(client[0].id);
        return client[0].id;
    }


    function getDateFilter() {
        let status = document.getElementById("filterDate");
        console.log(status.value);
        return status.value;
    }

    function getDatesFilter() {
        let startDate = document.getElementById("filterDateStart");
        let endDate = document.getElementById("filterDateEnd");
        console.log(startDate.value, "##", endDate.value);
        return [startDate.value, endDate.value];
    }

    function filterResults() {

        let comanyIds = getChecked("company");


        let providerId = getSelected();

        let getDate = getDateFilter();

        let getDates = getDatesFilter();
        // console.log(providerId);

        let href = '{{ collect(request()->segments())->last() }}?';

        if (comanyIds.length) {
            href += 'appFilter[GetCompany]=' + comanyIds;
        }
        if (providerId.length) {
            href += '&appFilter[GetProvider]=' + providerId;
        }
        if (getDate.length) {
            href += '&appFilter[GetBCDate]=' + getDate;
        }

        if (getDates.length) {
            href += '&appFilter[DateBetween]=' + getDates;
        }
        document.location.href = href;
        // return href;
    }

    document.getElementById("filterData").addEventListener("click", function(event) {

        event.preventDefault();
        filterResults();

        /*$.ajax({
            url: filterResults(),
            type: 'GET',
            success: function() {
                console.log("it Works");
                $("#invoices_lister").load(window.location.href + " #invoices_lister");
            }
        });*/
    });

    /*$(".chk-filter").on("click", function() {
        if (this.checked) {
           // $('#filter').click();
            filterResults()
        }
    });*/
</script>
