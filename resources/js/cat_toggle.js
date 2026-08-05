document.addEventListener("DOMContentLoaded", () => {
    const category_id = document.getElementById("category_id")
    const is_self_cat = document.getElementById("is_self_cat")
    const self_cat = document.getElementById("self_cat")

    if (!category_id || !is_self_cat || !self_cat) return

    is_self_cat.addEventListener("change", function () {
        if (this.checked) {
            category_id.disabled = true
            self_cat.disabled = false
        } else {
            category_id.disabled = false
            self_cat.disabled = true
        }
    })
});
