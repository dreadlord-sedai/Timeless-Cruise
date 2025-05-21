function signup() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("m", mobile.value);
    form.append("g", gender.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                window.location = "login.php";
            } else {
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    }

    request.open("POST", "signUpProcess.php", true);
    request.send(form);

}

function btnsign() {
    event.preventDefault();
}

function btnup() {
    event.preventDefault();
}

function signIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberMe = document.getElementById("rememberMe");

    var form = new FormData();
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("r", rememberMe.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                window.location = "index.php";
            } else {
                document.getElementById("msg1").innerHTML = response;
                document.getElementById("msgdiv1").className = "d-block";
            }
        }
    }

    request.open("POST", "signInProcess.php", true);
    request.send(form);
}

function signout() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                window.location = "index.php";
            }
        }
    }
    request.open("POST", "signOutProccess.php", true);
    request.send();
}


function showPassword1() {
    var textField = document.getElementById("np");
    var button = document.getElementById("npb");

    if (textField.type == "password") {
        textField.type = "text";
        button.innerHTML = "<i class='bx bxs-show'></i>";
    } else {
        textField.type = "password";
        button.innerHTML = "<i class='bx bxs-hide'></i>";
    }
}

function showPassword2() {
    var textField = document.getElementById("rp");
    var button = document.getElementById("rpb");

    if (textField.type == "password") {
        textField.type = "text";
        button.innerHTML = "<i class='bx bxs-show'></i>";
    } else {
        textField.type = "password";
        button.innerHTML = "<i class='bx bxs-hide'></i>";
    }
}

function forgotpw1() {
    var forgotEmail = document.getElementById("forgotemail1");

    var form = new FormData();
    form.append("fe", forgotEmail.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "Success") {
                window.location = "forgotpw2.php";
            } else {
                Swal.fire({
                    position: "top",
                    icon: "error",
                    title: response,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    }

    request.open("GET", "forgotPasswordProcess.php?fe=" + forgotEmail.value, true);
    request.send();
}

function fbutton() {
    event.preventDefault();
}

function forgotpw2() {
    var newPassword = document.getElementById("np");
    var RetypePassword = document.getElementById("rp");
    var verificationCode = document.getElementById("Vcode");

    var form = new FormData();
    form.append("vcode1", verificationCode.value);
    form.append("newPw", newPassword.value);
    form.append("retypePw", RetypePassword.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                window.location = "login.php";
            } else {
                Swal.fire({
                    position: "top",
                    icon: "error",
                    title: response,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    }

    request.open("POST", "forgotPasswordProcess2.php", true);
    request.send(form);
}

function f2button() {
    event.preventDefault();
}


function selectDistrict() {
    var province_id = document.getElementById("province").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("district").innerHTML = response;
            selectCity();
        }
    }

    request.open("GET", "selectDistrictProcess.php?id=" + province_id, true);
    request.send();
}


function selectCity() {
    var district_id = document.getElementById("district").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("city").innerHTML = response;
        }
    }

    request.open("GET", "selectCityProcess.php?id=" + district_id, true);
    request.send();
}


function changeProfileImage() {
    var img = document.getElementById("profileimage");

    img.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("image").src = url;
    }
}

function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var pcode = document.getElementById("pcode");
    var birth = document.getElementById("bcode");
    var gender = document.getElementById("gender");
    var mobile = document.getElementById("mobileN1");
    var address = document.getElementById("address");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pimage = document.getElementById("profileimage");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("pc", pcode.value);
    form.append("b", birth.value);
    form.append("g", gender.value);
    form.append("m", mobile.value);
    form.append("add1", address.value);
    form.append("c", city.value);
    form.append("i", pimage.files[0]);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Updated" || response == "Saved") {
                window.location.reload();
            } else if (response == "You Have Not Selected Any Profile Image.") {
                window.location.reload();
            } else {
                Swal.fire({
                    position: "top",
                    icon: "error",
                    title: response,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    }

    request.open("POST", "updateProfileProcess.php", true);
    request.send(form);
}


function changeProductImage() {
    var image = document.getElementById("imageuploader");

    image.onchange = function () {
        var file_count = image.files.length;

        if (file_count <= 3) {
            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("p" + x).src = url;
            }
        } else {
            alert(file_count + " files selected. You can Only upload 3 or less than 3 files.");
        }
    }
}


function addProduct() {
    var category = document.getElementById("p_category");
    var brand = document.getElementById("p_brand");
    var model = document.getElementById("p_model");
    var title = document.getElementById("p_title");
    var color = document.getElementById("p_color");
    var qty = document.getElementById("p_qty");
    var type = document.getElementById("p_type");
    var cost = document.getElementById("p_cost");
    var dwc = document.getElementById("p_d_c");
    var doc = document.getElementById("p_d_o");
    var p_d = document.getElementById("p_d");
    var imageuploader = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("cat", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("t", title.value);
    form.append("clr", color.value);
    form.append("q", qty.value);
    form.append("tp", type.value);
    form.append("cost", cost.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("d", p_d.value);

    var file_count = imageuploader.files.length;

    for (var x = 0; x < file_count; x++) {
        form.append("image" + x, imageuploader.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "Product Saved Successfully") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "addProductProcess.php", true);
    request.send(form);
}



function adminVerification() {
    var adminEmail = document.getElementById("a");

    var form = new FormData();
    form.append("a", adminEmail.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "Success") {
                window.location = "adminsignVcode.php";
            } else {
                Swal.fire({
                    position: "top",
                    icon: "error",
                    title: response,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    }

    request.open("POST", "adminEmail.php", true);
    request.send(form);
}


function adminverify() {
    var aVcode = document.getElementById("adminVcode");

    var form = new FormData();
    form.append("avc", aVcode.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                window.location = "dashboard.php";
            } else {
                Swal.fire({
                    position: "top",
                    icon: "error",
                    title: response,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    }

    request.open("POST", "adminVerificationProcess.php", true);
    request.send(form);
}


function adminsignout() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                window.location = "adminsign.php";
            }
        }
    }
    request.open("POST", "adminsignOutProccess.php", true);
    request.send();
}

function adveriB() {
    event.preventDefault();
}


function checkQty(qty) {
    var input = document.getElementById("qty_input");

    if (input.value <= 0) {
        alert("Quantity must be one or more.");
        input.value = 1;
    } else if (input.value > qty) {
        alert("Insufficient Quantity");
        input.value = qty;
    }
}

function addToWatchlist(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "Removed" || response == "Added") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    request.send();
}

function removeWachlist(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "Successfully Removed") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "removeWatchlistProcess.php?id=" + id, true);
    request.send();
}

function addCart(id, qty) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            alert(response);
        }
    }

    request.open("GET", "addCartProcess.php?id=" + id + "&qty=" + qty, true);
    request.send();
}

function deleteCart(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "Product Removed In Cart") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "deleteFromCartProcess.php?id=" + id, true);
    request.send();
}


function payNow(id) {

    var qty = document.getElementById("qty_input").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;

            var obj = JSON.parse(response);

            var mail = obj["umail"];
            var amount = obj["amount"];
            var size = obj["size"];
            var status = obj["orderstatus"];

            if (response == 1) {
                alert("Please Log In To Your Account.");
                window.location = "login.php";
            } else if (response == 2) {
                alert("Please Update Your Address.");
                window.location = "userProfile.php";
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer

                    alert("Payment completed. OrderID:" + orderId);
                    saveInvoice(orderId, id, mail, amount, qty, size, status);
                }

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                }

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                }

                // Put the payment variables here
                var payment = {
                    sandbox: true,
                    merchant_id: obj["mid"],    // Replace your Merchant ID
                    return_url: "http://localhost/ecommerce/singleProduct.php?id=" + id,     // Important
                    cancel_url: "http://localhost/ecommerce/singleProduct.php?id=" + id,     // Important
                    notify_url: "http://sample.com/notify",
                    order_id: obj["id"],
                    items: obj["item"],
                    amount: obj["amount"] + ".00",
                    currency: obj["currency"],
                    hash: obj["hash"],  // *Replace with generated hash retrieved from backend
                    first_name: obj["fname"],
                    last_name: obj["lname"],
                    email: obj["umail"],
                    phone: obj["mobile"],
                    size: obj["size"],
                    status_o: obj["orderstatus"],
                    address: obj["address"],
                    city: obj["city"],
                    country: "Sri Lanka",
                    delivery_address: obj["address"],
                    delivery_city: obj["city"],
                    delivery_country: "Sri Lanka",
                    custom_1: "",
                    custom_2: ""
                }

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                //document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                //};
            }
        }
    }

    request.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    request.send();
}


function saveInvoice(orderId, id, mail, amount, qty, size, status) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("i", id);
    form.append("m", mail);
    form.append("a", amount);
    form.append("q", qty);
    form.append("s", size);
    form.append("os", status);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "saveInvoiceProcess.php", true);
    request.send(form);
}

function printInvoice() {
    var restorePage = document.body.innerHTML;
    var page = document.getElementById("invoice_page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
}

var m;
function addFeedback(id) {
    var feedbackModel = document.getElementById("feedbackModal" + id);
    m = new bootstrap.Modal(feedbackModel);
    m.show();
}

function saveFeedback(id) {

    var feedback = document.getElementById("feed");
    var product_id = id;

    var form = new FormData();
    form.append("f", feedback.value);
    form.append("p", product_id);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                alert("Thanks Your FeedBack ! ");
                m.hide();
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "saveFeedBackProcess.php", true);
    request.send(form);
}


function sellHistorySearch() {
    var id = document.getElementById("selling_search");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (
                response == "Invalid Order ID" ||
                response == "Please add an Order ID First") {
                alert(response);
                window.location.reload();
            } else {
                document.getElementById("view_area").innerHTML = response;
            }
        }
    }

    request.open("GET", "searchSellingHistory.php?id=" + id.value, true);
    request.send();
}

function orderdate() {
    var order = document.getElementById("order_date");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (
                response == "Invalid Order Date" ||
                response == "Please add an Order Date First") {
                alert(response);
                window.location.reload();
            } else {
                document.getElementById("view_area_order").innerHTML = response;
            }
        }
    }

    request.open("GET", "orderDateProcess.php?order=" + order.value, true);
    request.send();
}


function purchaseTag(order_id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            alert(response);
            window.location.reload();
        }
    }

    request.open("GET", "purchaseOrderTagProcess.php?order_id=" + order_id, true);
    request.send();
}

function changeStatus(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "Deactivated" || response == "Activated") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "productStatusChangeProcess.php?id=" + id, true);
    request.send();
}

function updateProduct(id) {
    var utitle = document.getElementById("u_title");
    var utype = document.getElementById("u_type");
    var uqty = document.getElementById("u_qty");
    var uc = document.getElementById("udc");
    var uo = document.getElementById("udo");
    var udis = document.getElementById("ud");
    var images = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("t", utitle.value);
    form.append("ut", utype.value);
    form.append("uq", uqty.value);
    form.append("dwc", uc.value);
    form.append("doc", uo.value);
    form.append("d", udis.value);
    form.append("pid", id);

    var count = images.files.length;

    for (var x = 0; x < count; x++) {
        form.append("image" + x, images.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "Product Updated") {
                alert("Product Saved Successfully");
                window.location.reload();
            } else {
                alert(response);
                window.location.reload();
            }
        }
    }
    request.open("POST", "updateProductProcess.php", true);
    request.send(form);
}

function removeAdminProduct(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                alert("Product Delete Successfully");
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }
    request.open("GET", "removeAdminProductProcess.php?id=" + id, true);
    request.send();
}

