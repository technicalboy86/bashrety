App.api = function() {
	
	var config = {
		url: "",
		token: "1234567890",
		controller: "",
		action: "",
		method: "POST",
		callback: ""
	}

	return {
		loginUser: function(ref) {

		},

		addUser: function(ref) {
			console.log("Running addUser");
			if (ref.validate("new") === true) {
				data = ref.details;
				data.user_id = 1;
				ref.handleAdd(data);
			} else {
				console.log("User doesn't validate.");
			}
		}

	}
}
