<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<button id='saveForm' onclick="save();">Click Me</button>

<script src="./sweetalert.min.js"></script>

<script>
    function save() {
            var save = document.getElementById('saveForm');

            swal({
            title: "Your file is saved",
            icon: "success",
            buttons: false, // This will remove the button
            timer: 2000 // Optional: auto-close after 2 seconds
            });
        };
</script>
    
</body>
</html>

<script src="../../../Javascript/sweetalert.min.js"></script>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.getElementById("deleteForm").submit();
                } else {
                    
                }
            });
        };
    </script>