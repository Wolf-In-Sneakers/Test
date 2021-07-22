const delete_tag = async function (id_tag) {
    let response = await fetch('/tag/delete/' + id_tag);

    if (response.status === 200) {
        let item = document.querySelector(".list-group-item.list-group-item-action.d-flex.justify-content-between[data-id='" + id_tag + "']");
        item.parentElement.removeChild(item);

    } else {
        let result = await response.json();
        alert(result);
    }
}

const delete_category = async function (id_category) {
    let response = await fetch('/category/delete/' + id_category);

    if (response.status === 200) {
        let item = document.querySelector(".list-group-item.list-group-item-action.d-flex.justify-content-between[data-id='" + id_category + "']");
        item.parentElement.removeChild(item);

    } else {
        let result = await response.json();
        alert(result);
    }
}

const delete_sub_category = async function (id_sub_category) {
    let response = await fetch('/subcategory/delete/' + id_sub_category);

    if (response.status === 200) {
        let item = document.querySelector(".list-group-item.list-group-item-action.d-flex.justify-content-between[data-id='" + id_sub_category + "']");
        item.parentElement.removeChild(item);

    } else {
        let result = await response.json();
        alert(result);
    }
}

const delete_materail = async function (id_material) {
    let response = await fetch('/material/delete/' + id_material);

    if (response.status === 200) {
        let item = document.querySelector("tr.item[data-id='" + id_material + "']");
        item.parentElement.removeChild(item);

    } else {
        let result = await response.json();
        alert(result);
    }
}

const delete_material_tag = async function (id_material, id_tag) {
    let response = await fetch('/material/tag/delete/' + id_material + '/' + id_tag);

    if (response.status === 200) {
        let item = document.querySelector(".list-group-item.list-group-item-action.d-flex.justify-content-between.material_tag.material_tag[data-id='" + id_tag + "']");
        item.parentElement.removeChild(item);
    } else {
        let result = await response.json();
        alert(result);
    }
}

const delete_link = async function (id_link) {
    let response = await fetch('/link/delete/' + id_link);

    if (response.status === 200) {
        let item = document.querySelector(".list-group-item.list-group-item-action.d-flex.justify-content-between.link[data-id='" + id_link + "']");
        item.parentElement.removeChild(item);
    } else {
        let result = await response.json();
        alert(result);
    }
}

const delete_type = async function (id_type) {
    let response = await fetch('/type/delete/' + id_type);

    if (response.status === 200) {
        let item = document.querySelector(".list-group-item.list-group-item-action.d-flex.justify-content-between[data-id='" + id_type + "']");
        item.parentElement.removeChild(item);

    } else {
        let result = await response.json();
        alert(result);
    }
}


document.addEventListener("click", (event) => {
    if (event.target.closest(".delete-btn.tag")) {
        if (confirm("Вы действительно хотите удалить тег?"))
            delete_tag(+event.target.closest(".delete-btn.tag").dataset.id);
    } else if (event.target.closest(".delete-btn.category")) {
        if (confirm("Вы действительно хотите удалить категорию?"))
            delete_category(+event.target.closest(".delete-btn.category").dataset.id);
    } else if (event.target.closest(".delete-btn.subcategory")) {
        if (confirm("Вы действительно хотите удалить подкатегорию?"))
            delete_sub_category(+event.target.closest(".delete-btn.subcategory").dataset.id);
    } else if (event.target.closest(".delete-btn.material")) {
        if (confirm("Вы действительно хотите удалить материал?"))
            delete_materail(+event.target.closest(".delete-btn.material").dataset.id);
    } else if (event.target.closest(".delete-btn.material_tag")) {
        if (confirm("Вы действительно хотите удалить тег из материалов?"))
            delete_material_tag(+event.target.closest(".delete-btn.material_tag").dataset.id, +event.target.closest(".delete-btn.material_tag").dataset.id_tag);
    } else if (event.target.closest(".delete-btn.link")) {
        if (confirm("Вы действительно хотите ссылку?"))
            delete_link(+event.target.closest(".delete-btn.link").dataset.id);
    } else if (event.target.closest(".delete-btn.type")) {
        if (confirm("Вы действительно хотите удалить тип?"))
            delete_type(+event.target.closest(".delete-btn.type").dataset.id);
    }
});
