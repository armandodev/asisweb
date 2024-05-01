const $form = document.getElementById("search-form");
const $input = $form.querySelector("input");

$form.addEventListener("submit", (e) => {
  e.preventDefault();
  const search = $input.value.trim();
  window.location.href = `./subjects.php?search=${search}`;
});
