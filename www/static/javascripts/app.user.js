App.user = function() {
	return {
		details: {
			user_id: null,
			logged_in: null,
			email: null,
			password: null,
			firstName: null,
			lastName: null,
			city: null,
			state: null,
			country: null,
			phone: null,
			image_url: null
		},

		errors: [],
		
		loginUser: function() {
			this.gatherLoginDetails();
			var api = new App.api();
			api.loginUser(this);
		},

		addCollaborator: function() {
			// You were here.
			var DB = new App.db();
			DB.open();
			var p = [this.details.email, this.details.first_name, this.details.last_name, this.details.phone];
			var q = "INSERT OR IGNORE INTO `user` (`email`, `first_name`, `last_name`, `phone`) VALUES (?, ?, ?, ?)";
			DB.db.transaction(
				function(transaction) {
					transaction.executeSql(q, p, 
						function(transaction, results) {
							if (results.insertId != undefined) {
								console.log("Collaborator: " + results.insertId);
							}
						}, 
						function(transaction, results) {
							//console.log(results);
						}
					);
				}
			);
		},

		handleLogin: function(data) {
			console.log(data);
			//console.log("API: " + data.message);
			if (data.id != undefined && data.id != null) {
				this.details.current_user = App.current_user.details.current_user = 1;
				this.details.id = App.current_user.details.user_id = data.id;
				this.details.email = App.current_user.details.email = data.email;
				this.details.first_name = App.current_user.details.firstName = data.first_name;
				this.details.last_name = App.current_user.details.lastName = data.last_name;
				this.details.city = App.current_user.details.city = data.city;
				this.details.state = App.current_user.details.state = data.state;
				this.details.country = App.current_user.details.country = data.country;
				this.details.phone = App.current_user.details.phone = data.phone;
				this.details.user_image = App.current_user.details.user_image = data.user_image;

				App.database.addUser(this.details);
				// Do something to show user added.
				Lungo.Notification.success('Success', 'Your login was a great success!', 'ok', 2, function() {
					Lungo.Notification.hide();

					var m = new App.moments();
					m.getMoments();

					//Lungo.Router.section("home");
				});
			} else if (data.Error != undefined) {
				Lungo.Notification.error('Error', data.Error, 'remove', 3);
			} else {
				Lungo.Notification.error('Error', data, 'remove', 3);
			}
		},

		getLoggedInUser: function() {
			console.log("Checking DB for user.");
			// Check the local DB for a logged in user. Result handled by handleGetUserDB below.
			
			App.database.getCurrentUser(this);
		},

		handleGetUserDB: function(transaction, results) {
			var data = results.rows.item(0);
			console.log(data);
			if (data.id != undefined && data.id != null) {
				console.log(App.current_user);
				App.current_user.details.current_user = 1;
				App.current_user.details.user_id = data.id;
				App.current_user.details.email = data.email;
				App.current_user.details.firstName = data.firstName;
				App.current_user.details.lastName = data.lastName;
				App.current_user.details.city = data.city;
				App.current_user.details.state = data.state;
				App.current_user.details.country = data.country;
				App.current_user.details.phone = data.phone;
				App.current_user.details.user_image = data.user_image;
				console.log("App.current_user.details.user_id:" + App.current_user.details.user_id);
				// Get moments?
				var DB = new App.db();
				DB.open();
				DB.db.transaction(
					function(transaction) {
						transaction.executeSql("SELECT MAX(`servertime`) AS `last_sync` FROM `moment_sync`;", [], 
							function(transaction, results) {
								console.log(results);
								console.log(results.rows.item(0));
								App.current_user.details.last_sync = results.rows.item(0).last_sync	;
								this.moments = new App.moments();
								this.moments.getMoments();
							},
							function(transaction, results) {
								console.log(results);
							}
						);
					}
				);

			}
		},

		gatherLoginDetails: function() {
			this.details = {
				email: Lungo.dom("#login-email").val(),
				password: Lungo.dom("#login-password").val()
			}
		},

		validateLogin: function() {
			console.log("Validating.")
			if (this.details.email == null) {
				this.errors.push("You should have an email.");
			}
			if (this.details.password == null) {
				this.errors.push("You should have a password.");
			}

			if (this.errors.length) {
				console.log("Problem(s) encountered validating user data.");
				for (var i = 0; i < this.errors.length; i++) {
					console.log(this.errors[i]);
				}
				return false;
			} else {
				return true;
			}
		},

		logout: function() {
			App.database.destroyDB('logout');
		},

		addUser: function() {
			this.gatherDetails();
			var api = new App.api();
			api.addUser(this);
		},

		updateUser: function() {
			this.gatherSettingsDetails();
			var api = new App.api();
			api.updateUser(this);
		},

		handleAdd: function(data) {
			console.log(data);
			console.log("API: " + data.message);
			if (data.user_id != undefined && data.user_id != null) {
				this.details.user_id = data.user_id;
				this.details.current_user = 1;
				App.database.addUser(this.details);
					// Do something to show user added.
				Lungo.Router.section("walkthrough-share");
			}
		},

		handleUpdateUser: function(data) {
			console.log(data);
			console.log("API: " + data.message);
			Lungo.Notification.success('Success', 'Your login was a great success!', 'ok', 2);
		},

		gatherDetails: function() {
			// Pull values from form to details object.
			this.details = {
				email: Lungo.dom("#signup-emailadd").val(),
				password: Lungo.dom("#signup-password").val(),
				firstName: Lungo.dom("#signup-firstname").val(),
				lastName: Lungo.dom("#signup-lastname").val(),
				city: Lungo.dom("#signup-city").val(),
				state: Lungo.dom("#signup-state").val(),
				country: Lungo.dom("#signup-country").val(),
				phone: Lungo.dom("#signup-phone").val(),
				image_url: "http://tinyurl.com/dfshdk"
			};
		},

		gatherSettingsDetails: function() {
			// Pull values from form to update the details object.
			this.details.user = this.details.user_id;
			this.details.email = Lungo.dom("#settings-email").val();
			this.details.oldPassword = Lungo.dom("#settings-current-password").val();
			this.details.newPassword = Lungo.dom("#settings-new-password1").val();
			this.details.newPassword2 = Lungo.dom("#settings-new-password2").val();
			this.details.firstName = Lungo.dom("#settings-firstname").val();
			this.details.lastName = Lungo.dom("#settings-lastname").val();
			this.details.city = Lungo.dom("#settings-city").val();
			this.details.state = Lungo.dom("#settings-state").val();
			this.details.country = Lungo.dom("#settings-country").val();
			this.details.phone = Lungo.dom("#settings-phonenumber").val();
			this.details.push_notify = ((Lungo.dom("#settings-push").get(0).checked) ? "1" : "0");
			this.details.email_notify = ((Lungo.dom("#settings-email-share").get(0).checked) ? "1" : "0");
			this.details.newsletter = ((Lungo.dom("#settings-newsletter").get(0).checked) ? "1" : "0");
		},

		validate: function(neworupdate) {
			if (neworupdate == null) {
				neworupdate = "new";
			}
			console.log("Validating.")
			// if (this.details.user_id == null) {
			// 	this.errors.push("You should have a user_id.");
			// }
			if (this.details.email == null) {
				this.errors.push("You should have an email.");
			}
			if (neworupdate == "new") {
				if (this.details.password == null) {
					this.errors.push("You should have a password.");
				}
			}
			if (neworupdate == "update") {
				if (this.details.oldPassword == null || this.details.newPassword != null || this.details.newPassword2 == null) {
					if (this.details.oldPassword == null || this.details.oldPassword.length) {
						this.errors.push("You must provide your old password.");
					}
					if (this.details.newPassword2 == null || this.details.newPassword2.length) {
						this.errors.push("You must verify your password.");
					}
					if (this.details.newPassword != null && this.details.newPassword2 == null) {
						if (this.details.newPassword != this.details.newPassword2) {
							this.errors.push("Both new password values must match.");
						}
					}
				}
			}
			if (this.details.firstName == null) {
				this.errors.push("You should have a firstName.");
			}
			if (this.details.lastName == null) {
				this.errors.push("You should have a lastName.");
			}
			if (this.details.city == null) {
				this.errors.push("You should have a city.");
			}
			if (this.details.state == null) {
				this.errors.push("You should have a state.");
			}
			if (this.details.country == null) {
				this.errors.push("You should have a country.");
			}
			// if (this.details.phone == null) {
			// 	this.errors.push("You should have a phone.");
			// }
			// if (this.details.image_url == null) {
			// 	this.errors.push("You should have a image_url.");
			// }
			if (this.errors.length) {
				console.log("Problem(s) encountered validating user data.");
				for (var i = 0; i < this.errors.length; i++) {
					console.log(this.errors[i]);
				}
				return false;
			} else {
				return true;
			}
		},

		getCollaborators: function() {
			this.details = {
				user: App.current_user.details.user_id
			}
			var api = new App.api();
			api.getCollaborators(this);
		},

		handleGetCollaborators: function(data) {
			console.log(data);
			console.log("API: " + data.message);
			if (data.collaborators != undefined && data.collaborators != null) {
				var c = data.collaborators;
				Lungo.dom("#people-article-ul").html("");
				for (var i = 0; i < c.length; i++) {
					var new_li = "<li class=\"arrow\" data-view-section=\"person\">\
						<div class=\"user-avatar avatar-medium avatar-shadow\">\
							<img src=\"" + App.config.image_prefix + c[i].user_image + "\"/>\
						</div>\
						<div>\
							<strong class=\"text bold\">" + c[i].first_name + " " + c[i].last_name + "</strong>\
							<span class=\"text tiny\">" + c[i].city + ", " + c[i].ctate + "</span>\
							<br/>\
							<div class=\"num-collaborations\">\
								<span class=\"num\">" + c[i].collaborations + "</span>\
								<span> collaborations</span>\
							</div>\
						</div>\
					</li>";
					Lungo.dom("#people-article-ul").append(new_li);
					delete new_li;
				}
				// this.details.user_id = data.user_id;
				// this.details.current_user = 1;
				// App.database.addUser(this.details);
				
				// Do something to show user added.
				Lungo.Router.section("people");
			}
			
		}
	}
}
