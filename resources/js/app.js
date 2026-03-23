import "./bootstrap";

window.Echo.private("App.Models.User." + id).notification((event) => {
    $("#notify-msg").prepend(`
                <div class="dropdown-item d-flex justify-content-between align-items-center">
                        <span>${event.user_name} added comment to your post</span>
                            <a href="${event.link}?notify=${event.id}"><i
                                class="fas fa-eye"></i></a>
                </div>
    `);

    count = Number($("#notify-count").text());
    count++;
    $("#notify-count").text(count);

});