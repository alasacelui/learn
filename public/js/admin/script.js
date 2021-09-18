axios.default.headers = { "content-type": "application/json" };
const token = $('meta[name="csrf-token"]').attr("content");
const baseUrl = window.location.origin;

//Add a request interceptor
axios.interceptors.request.use(
    function (config) {
        // set the csrf token
        config.headers["X-CSRF-TOKEN"] = token;
        return config;
    },
    function (error) {
        // Do something with request error
        return Promise.reject(error);
    }
);

// FOR COURSE TMP FILE UPLOAD

// Get a reference to the file input element
const image = document.querySelector("#c_image");
// Create a FilePond instance
const pond = FilePond.create(image, {
    storeAsFile: true,
    server: {
        url: `${baseUrl}/tmp_upload`,
        headers: {
            "X-CSRF-TOKEN": `${token}`,
        },
        revert: "/revert",
    },
});

$(() => {
    if (window.location.href === route("course.index")) {
        const course_data = [
            { data: "id" },
            { data: "title" },
            { data: "subtitle" },
            {
                data: "description",
                render(val) {
                    const descriptions = val.split(";");
                    let data = "<ul>";

                    descriptions.splice(0, 5).forEach((d) => {
                        data += `<li> ${d}</li>`;
                    });
                    data += "</ul>";

                    return data;
                },
            },
            { data: "price" },
            { data: "instructor" },
            {
                data: "image",
                render(data) {
                    return `<img src='${data}' class='img-thumbnail' width='200'>`;
                },
            },
            { data: "category" },
            { data: "actions", orderable: false, searchable: false },
        ];

        c_index($(".course_dt"), route("course.index"), course_data);
    }

    if (window.location.href === route("category.index")) {
        const category_data = [
            { data: "id" },
            { data: "category" },
            { data: "actions", orderable: false, searchable: false },
        ];

        c_index($(".category_dt"), route("category.index"), category_data);
    }
});

// crud function

async function c_index(dt, route, column) {
    //axios.get("/admin/course").then((res) => console.log(res));
    $(dt).DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        autoWidth: false,
        ajax: route,
        columns: column,
    });
}

// crud create
function toggle_modal(modal, form, modal_title, buttons, opt = "") {
    // if there is an optional parameter then execute the query
    // opt [route_name, element target (where to append the data)]
    if (opt) {
        axios.get(route(opt.rname)).then((res) => {
            let data = `<option></option>`;
            res.data.results.forEach((category) => {
                data += `<option value='${category.id}'>${category.category}</option>`;
            });
            $(opt.target).html(data); // append the category data []
        });
    }
    $(modal).modal("show"); // show modal dialog
    $(form)[0].reset(); // clear input field
    $(modal_title[0]).html(
        `${modal_title[1]} <i class="fas fa-plus-circle"></i> `
    );
    $(buttons[0]).css("display", "block"); // add button
    $(buttons[1]).css("display", "none"); // update button
}

async function c_store(form, dt, route_name) {
    // convert the first form in the parameter into a form data object
    const form_data = new FormData($(form)[0]);

    try {
        // request
        const res = await axios.post(route(route_name), form_data);
        success(res.data.message);
        $(form)[0].reset(); // clear input field
        pond.removeFiles();
        $(dt).DataTable().draw(); // update dt
    } catch (e) {
        log(e);
    }
}

// crud edit
function c_edit(modal, form, modal_title, buttons, model, opt = "") {
    if (opt) {
        // if there is an optional parameter then execute the query
        // opt [route_name, element target (where to append the data)]
        if (opt) {
            axios.get(route(opt.rname)).then((res) => {
                let data = `<option value='${model.category_id}'>${model.category} (Current)</option>`;
                res.data.results.forEach((category) => {
                    data += `<option value='${category.id}'>${category.category}</option>`;
                });
                $(opt.target).html(data); // append the category data []
            });
        }
    }

    $(modal).modal("show");
    $(modal_title[0]).html(`${modal_title[1]} <i class="fas fa-edit"></i> `);
    $(buttons[0]).css("display", "none"); // add button
    $(buttons[1]).css("display", "block").attr("data-id", model.id); // show update button and append a model id to it

    const key_val = Object.entries(model); // ex output (6) [ 0:{0:id, 1:test}, 1:{0:id, 1:test2}]

    const form_field = $(form); // get all input field inside a form

    // loop each input fields and find its match input name to the model instance
    form_field.each((key, val) => {
        key_val.forEach((k) => {
            if (val.type == "text" || val.type == "number") {
                if (k[0] == val.name) {
                    val.value = k[1];
                }
            }
        });
    });
}

// crud update
async function c_update(form, dt, route_name, e) {
    // convert the first form in the parameter into a form data object
    const form_data = new FormData($(form)[0]);
    form_data.append("_method", "PUT");
    const model_id = e.target.getAttribute("data-id");

    try {
        // request
        const res = await axios.post(
            `${route(route_name, model_id)}`,
            form_data
        ); // fake update request
        success(res.data.message);
        pond.removeFiles();
        $(dt).DataTable().draw(); // update dt
    } catch (e) {
        log(e);
    }
}

// crud destroy
async function c_destroy(id, routename, dt) {
    const result = await confirm();
    if (result.isConfirmed) {
        try {
            const res = await axios.delete(route(routename, id));
            this.success(res.data.message);
            $(dt).DataTable().draw(); // update dt
        } catch (e) {
            log(e);
        }
    }
}

// global function
function log(data) {
    return console.log(data);
}

function success(msg) {
    Swal.fire({
        icon: "success",
        title: `${msg}`,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
}

function error(msg) {
    Swal.fire({
        icon: "error",
        title: `${msg}`,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Vue.swal.stopTimer);
            toast.addEventListener("mouseleave", Vue.swal.resumeTimer);
        },
    });
}

function confirm() {
    return Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => result);
}
