import "./bootstrap";

window.Echo.private("App.Models.User." + id).notification((event) => {
    $("#notify-msg").prepend(`
        <div class="dropdown-item d-flex justify-content-between align-items-center border-bottom py-2 px-3" style="white-space: normal; font-size: 0.85rem;">
                                            <span><strong>${ event.user_name }</strong> added comment</span>
                                            <a href="${ event.link }?notify=${ event.id }" class="btn btn-sm btn-link p-0 text-primary ml-2"><i class="fas fa-eye"></i></a>
                                        </div>
    `);

    let count = Number($("#notify-count").text());
    count++;
    $("#notify-count").text(count);
});
