$(function() {
	// Setup

	function loadCart() {
		$.ajax({
			url:"./controller/cart-controller.php",
			method:"GET",
			data:{getCart:""},
			success: function(data) {
				var cart = data["cart"]; //var cart = data["cart"] ?? {}; // Chrome does not support coalescence yet.
				console.log(cart); // For debugging
				cart.forEach(function(item) { createItem(item.id, item.image, item.name, item.count, item.price); });
				$("#total-price").text(`€${parseFloat(data["totalPrice"].toFixed(2))}`);
			},
			error: function() {
				console.log("There was an error with the 'cart' AJAX call.");
			}
		});
	}





	// Interaction Events

	$(document).on("change", ".cartitem-count", function() {
		if($(this).val() < 1) { $(this).val(1); } // Only 1 or more is allowed

		let that = this;
		$.get("/controller/cart-controller.php", {itemId:getItemId(this), action:"setCount", count:this.value}).done(function() {
			updateItemPrice(getItemId(that)); //Update price if successfull
			updateTotalPrice();
			$(that).data("lastCount", that.value); // Update last count
		}).fail(function() {
				//$(this).val($(this).data("lastCount") ?? $(this).defaultValue); // Undo change // Chrome does not support coalescence yet.
				$(that).val($(that).data("lastCount")); // Undo change
		});
	});

	$(document).on("click", ".cartitem-decrement", function() {
		var countElement = $(this).siblings(".cartitem-count");
		if(countElement.val() > 1) { // Do not decrement if result would become less than 1.
			let that = this;
			$.get("controller/cart-controller.php", {itemId:getItemId(this), action:"decrement"}).done(function() {
				updateItemPrice(getItemId(that)); //Update price if successfull
				updateTotalPrice();
			}).fail(function() {
				countElement.val(+countElement.val()+1); // Undo change
			});
			countElement.val(+countElement.val()-1);
		}
	});

	$(document).on("click", ".cartitem-increment", function() {
		var countElement = $(this).siblings(".cartitem-count");
		let that = this;
		$.get("controller/cart-controller.php", {itemId:getItemId(this), action:"increment"}).done(function() {
			updateItemPrice(getItemId(that)); //Update price if successfull
			updateTotalPrice();
		}).fail(function() {
			countElement.val(+countElement.val()-1); // Undo change
		});
		countElement.val(+countElement.val()+1);
	});
	
	$(document).on("click", ".cartitem-remove", function() {
		var cartItemElement = $(this).parent();
		$.get("controller/cart-controller.php", {itemId:getItemId(this), action:"remove"}).done(function() {
			cartItemElement.remove(); // Remove completely if successful
			updateTotalPrice();
		}).fail(function() {
			cartItemElement.show(); // Re-appear if unsuccessfull (Undo change)
		});
		cartItemElement.hide(); // Hide until confirmed for removal
	});

	$(document).on("click", ".addbtn", function() {
		$.get("controller/cart-controller.php", {eventId: getEventId(this)}).done(function(data) {
			//var cartItem = data["item"] ?? {}; // Chrome does not support coalescence yet.
			if(data["item"]) {
				let cartItem = data["item"];
				createItem(cartItem.id, cartItem.image, cartItem.name, cartItem.count, cartItem.price);
				updateTotalPrice();
			} else if (data["added"]) {
				let countElement = $(`.cartitem[name$="${data["itemId"]}"] .cartitem-count`);
				countElement.val(+countElement.val()+1);
				updateItemPrice(data["itemId"]);
				updateTotalPrice();
			}
		});
	});





	// TOOLS
	function createItem(id, image, name, count, price) {
		$("#cart-items").append(generateItemHtml(id, image, name, count, price));
		var cartItemElement = $("#cart-items > .cartitem").last();
		cartItemElement.data("id", id);
		cartItemElement.children(".cartitem-count").data("lastCount", count);
		cartItemElement.children(".cartitem-price").data("singlePrice", price);
	}

	function generateItemHtml(id, image, name, count, price) {
		var html =
		`<div class="cartitem" name="cartitem-${id}">` +
		` <img src="${image}">` +
		` <p class="cartitem-name">${name}</p>` +
		` <button class="cartitem-decrement">-</button>` +
		` <input type="number" class="cartitem-count" min=1 max=10 value="${count}">` +
		` <button class="cartitem-increment">+</button>` +
		` <p class="cartitem-price">€${parseFloat((price*count).toFixed(2))}</p>` +
		` <button class="cartitem-remove"><img src="/icon/delete.svg"></button>` +
		`</div>`;

		return html;
	}

	function getItemId(element) {
		return $(element).closest(".cartitem").data("id");
	}

	function getEventId(element) {
		return $(element.closest(".eventcard")).attr("name").match(/[0-9]+/)[0];
	}

	function updateItemPrice(itemId) {
		var cartItemElement = $(`.cartitem[name$="${itemId}"]`);
		var priceElement = cartItemElement.children(".cartitem-price");
		var countElement = cartItemElement.children(".cartitem-count");

		var newPrice = priceElement.data("singlePrice") * countElement.val();
		priceElement.text(`€${parseFloat(newPrice.toFixed(2))}`);
	}

	function updateTotalPrice() {
		var totalPrice = 0;
		$("#cart-items").children().each(function() { console.log($(this).find(".cartitem-price").text().match(/[0-9]+/)[0]); totalPrice += parseFloat($(this).find(".cartitem-price").text().match(/[0-9]+/)[0]); });
		$("#total-price").text(`€${parseFloat(totalPrice.toFixed(2))}`);
	}





	// Execution

	loadCart();
});