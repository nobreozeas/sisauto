$(document).ready(function () {
	$(document).on('click', '#checkAll', function () {
		$(".itemRow").prop("checked", this.checked);
	});
	$(document).on('click', '.itemRow', function () {
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function () {
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
		htmlRows += '<td><input type="text" name="productCode[]" id="productCode_' + count + '" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="productName[]" id="productName_' + count + '" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="number" name="quantity[]" id="quantity_' + count + '" class="form-control quantity" autocomplete="off"></td>';
		htmlRows += '<td><input type="number" name="price[]" id="price_' + count + '" class="form-control price" autocomplete="off"></td>';
		htmlRows += '<td><input type="number" name="total[]" id="total_' + count + '" class="form-control total" autocomplete="off"></td>';
		htmlRows += '</tr>';
		$('#invoiceItem').append(htmlRows);
	});
	$(document).on('click', '#removeRows', function () {
		$(".itemRow:checked").each(function () {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});
	$(document).on('blur', "[id^=quantity_]", function () {
		calculateTotal();
	});
	$(document).on('blur', "[id^=price_]", function () {
		calculateTotal();
	});
	$(document).on('blur', "#taxRate", function () {
		calculateTotal();
	});
	$(document).on('blur', "#amountPaid", function () {
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();
		if (amountPaid && totalAftertax) {
			totalAftertax = totalAftertax - amountPaid;
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}
	});
	$(document).on('click', '.deleteInvoice', function () {
		var id = $(this).attr("id");
		if (confirm("Are you sure you want to remove this?")) {
			$.ajax({
				url: "action.php",
				method: "POST",
				dataType: "json",
				data: { id: id, action: 'delete_invoice' },
				success: function (response) {
					if (response.status == 1) {
						$('#' + id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});

	
});
function calculateTotal() {
	var totalAmount = 0;
	$("[id^='price_']").each(function () {
		var id = $(this).attr('id');
		id = id.replace("price_", '');
		var price = $('#price_' + id).val();
		var quantity = $('#quantity_' + id).val();
		if (!quantity) {
			quantity = 1;
		}
		var total = price * quantity;
		total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
		$('#total_' + id).val(parseFloat(total));
		totalAmount += total;
	});
	$('#subTotal').val(parseFloat(totalAmount));
	var taxRate = $("#taxRate").val();
	var subTotal = $('#subTotal').val();
	if (subTotal) {
		var taxAmount = subTotal * taxRate / 100;
		subTotal = parseFloat(subTotal) - parseFloat(taxAmount);
		var sb = subTotal.toFixed(2);
		$('#totalAftertax').val(sb);
		var amountPaid = $('#amountPaid').val();
		var totalAftertax = $('#totalAftertax').val();
		if (amountPaid && totalAftertax) {
			totalAftertax = totalAftertax - amountPaid;
			tt = totalAftertax.toFixed(2);
			$('#amountDue').val(tt);
		} else {
			$('#amountDue').val(sb);
		}
	}
}


$(document).ready(function () {  // A DIFERENÇA ESTA AQUI, EXECUTA QUANDO O DOCUMENTO ESTA "PRONTO"
	$("#msg").fadeIn(300).delay(2400).fadeOut(400);
});


$(function () {
	$("#pesquisa").keyup(function () {
		pesquisa = $(this).val();

		if (pesquisa != '') {
			var dados = {
				palavra: pesquisa
			}
			$.post('pesquisa.php', dados, function (retorna) {
				$(".resultado").html(retorna);
			});
			
		}
		
	});
});







