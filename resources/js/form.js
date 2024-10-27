import axios from "axios";
import crossIcon from "./../imgs/cross.svg";

export function update_collection_assets() {
    let doc_id = $("#edit-documentation").attr("data-document-id");

    axios.get("/documentation/list-assets/" + doc_id).then(function (response) {
        let inner_html = "";

        let assets = response.data;

        assets.data.forEach(function (asset) {
            inner_html += `
            <div class="collection-assets__list-item">
                <p class="collection-assets__field" ">${asset.name}</p>
                <div class="collection-assets__actions">
                    <button type="button" class="action--delete action-ajax" data-action='/admin/documentation/delete-asset/${asset.id}' data-then-js="update_collection_assets"/>
                        <img src=${crossIcon} />
                    </button>
                </div>
            </div>
            <hr class="collection-assets__separator"/>
            `;
        });

        $(".collection-assets__list").each(function () {
            $(this).html(inner_html);
            set_handlers(this);
        });
    });
}

function set_handlers(elem) {
    $(elem).find(".form__pill").click(function () {
        let clicked_pill = $(this);
        $(this)
            .parent()
            .children("")
            .map(function (key, elem) {
                $(elem).find("input").attr("checked", $(elem).is(clicked_pill));
            });
    });

    $(elem).find(".input-ajax").change(function () {
        let action = $(this).attr("data-action");
        let name = $(this).attr("name");
        let type = $(this).attr("type");
        let then = $(this).attr("data-then-js");

        var form_data = new FormData();
        var image_file = $(this).get()[0];

        if (type === "file") {
            Array.from(image_file.files).forEach((file) => {
                form_data.append(name, file);
            });
        } else {
            form_data.append(name, image_file.value);
        }

        axios
            .post(action, form_data, {
                headers: { "Content-Type": "multipart/form-data" },
            })
            .then(function() {
                eval(then)();
            });
    });

    $(elem).find(".action-ajax").click(function () {
        let action = $(this).attr("data-action");
        let then = $(this).attr("data-then-js");

        axios.post(action).then(function () {
            eval(then)();
        });
    });
}

$(document).ready(function () {
    set_handlers(document);
    update_collection_assets();
});
