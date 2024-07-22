// document.addEventListener("DOMContentLoaded", function() {
//     var searchInput = document.getElementById('search');
//     var customerTableBody = document.getElementById('customer-table-body');

//     searchInput.addEventListener('keyup', function() {
//         var query = searchInput.value;

//         fetch('/customer/ajax-search?query=' + query)
//             .then(function(response) {
//                 return response.json();
//             })
//             .then(function(data) {
//                 customerTableBody.innerHTML = '';
//                 data.forEach(function(customer) {
//                     customerTableBody.innerHTML += `
//                         <tr>
//                             <td>${customer.id}</td>
//                             <td>${customer.name}</td>
//                             <td>${customer.email}</td>
//                             <td>${customer.phone}</td>
//                             <td>${customer.address}</td>
//                             <td>${customer.gender}</td>
//                             <td>${customer.dob}</td>
//                             <td>
//                                 <a href="/customer/edit/${customer.id}" class="btn btn-primary btn-sm">Edit</a>
//                                 <form action="/customer/soft-delete/${customer.id}" method="POST" style="display: inline-block;">
//                                     <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
//                                     <input type="hidden" name="_method" value="DELETE">
//                                     <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to move this customer to trash?')">Move to Trash</button>
//                                 </form>
//                                 <form action="/customer/delete/${customer.id}" method="POST" style="display: inline-block;">
//                                     <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
//                                     <input type="hidden" name="_method" value="DELETE">
//                                     <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to permanently delete this customer?')">Permanent Delete</button>
//                                 </form>
//                             </td>
//                         </tr>
//                     `;
//                 });
//             })
//             .catch(function(error) {
//                 console.error('Error fetching data:', error);
//             });
//     });
// });
$(document).ready(function() {
    var searchInput = $('#search');
    var customerTableBody = $('#customer-table-body');

    searchInput.on('keyup', function() {
        var query = searchInput.val();

        $.ajax({
            url: '/customer/ajax-search',
            method: 'GET',
            data: { query: query },
            success: function(data) {
                customerTableBody.empty();
                $.each(data, function(index, customer) {
                    customerTableBody.append(`
                        <tr>
                            <td>${customer.id}</td>
                            <td>${customer.name}</td>
                            <td>${customer.email}</td>
                            <td>${customer.phone}</td>
                            <td>${customer.address}</td>
                            <td>${customer.gender}</td>
                            <td>${customer.dob}</td>
                            <td>
                                <a href="/customer/edit/${customer.id}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="/customer/soft-delete/${customer.id}" method="POST" style="display: inline-block;">
                                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to move this customer to trash?')">Move to Trash</button>
                                </form>
                                <form action="/customer/delete/${customer.id}" method="POST" style="display: inline-block;">
                                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to permanently delete this customer?')">Permanent Delete</button>
                                </form>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    });
});
