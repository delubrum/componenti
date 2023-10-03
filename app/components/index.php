        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
        
        <div class="mx-10 my-4 p-4 bg-white rounded-md">
          <table class="w-full display table-striped text-sm" id="list">
              <thead>
                <tr>
                  <?php foreach($fields as $f) { ?>
                    <th <?php echo ($f == 'action') ? "style='text-align:right'" : "" ?>> <?php echo ucwords($f) ?> </th>
                  <?php } ?>
                </tr>
              </thead>
            </table> 
        </div>

      </main>
    </div>
  </body>
</html>

<script>
  var table = $('#list').DataTable({
    order: [[1, 'asc']],
    lengthChange : false,
    paginate: false,
    scrollX : true,
    autoWidth : false,
    ajax: {
      url: "<?php echo $url ?>",
      dataSrc: ''
    },
    'columns': [
      <?php foreach($fields as $f) {
        echo "{data: '$f'},";
      } ?>
    ],
  });

  $('#list_wrapper').prepend("<button hx-get='/?c=Users&c=New' hx-target='body' hx-swap='beforeend' class='float-right bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>New</button>");
  
</script>