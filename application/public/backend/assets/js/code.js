$(function () {
  $(document).on('click', '#delete', function (e) {
    e.preventDefault();
    var link = $(this).attr("href");


    Swal.fire({
      title: 'Are you sure?',
      text: "Delete This Data?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
      }
    })


  });

});


$(function () {
  $(document).on('click', '#ApproveBtn', function (e) {
    e.preventDefault();
    var link = $(this).attr("href");


    Swal.fire({
      title: 'Are you sure?',
      text: "Approve This Data?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, approve it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Approved!',
          'Your file has been approved.',
          'success'
        )
      }
    })


  });

});

$(document).on("click", "#return", function (e) {

  e.preventDefault();
  var link = $(this).attr("href");
  swal({
    title: "Do you want to return this order?",
    text: "Once return, this will be refunded",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })

    .then((willDelete) => {
      if (willDelete) {
        window.location.href = link;
      } else {
        swal("Cancel!");
      }
    });

});
