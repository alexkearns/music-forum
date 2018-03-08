window._ = require('lodash');
const swal = require('sweetalert2');

/**
 * Show a sweet alert to delete an item.
 * @param  type - what is being deleted, thread or post.
 * @param  url - route to delete item.
 */
window.warningAlert = function(url) {
	swal({
		title: 'Are you sure?',
		text: 'This will be gone forever!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Yes, delete it!',
		cancelButtonText: 'No, keep it'
	}).then(result => {
		if (result.value) {
			swal('Deleted!', 'This has been deleted.', 'success');
			window.location.href = url;
		} else if (result.dismiss === swal.DismissReason.cancel) {
			swal('Cancelled', 'This is safe :)', 'error');
		}
	});
};

$("button.sa-delete").click(function(e) {
    warningAlert(e.currentTarget.value);
});