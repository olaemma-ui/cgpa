<div class="w-full bg-darker fixed bottom-0 p-2 text-white text-center border-t-dark">
  Developed by Olaemma
</div>
</body>
  <script>
    var bool = true;
    document.querySelector("#btn").addEventListener("click", function () {
      document.querySelector("#btn").style.cssText = "border: none; background: rgba(30, 64, 175, var(--tw-bg-opacity);";
      if (bool) {
        document.querySelector(".sidebar").classList.replace("left", "right");
        document.querySelector("#ic").classList.replace("fa-bars", "fa-times");
        document.querySelector(".sidebar").classList.replace("hidden", "visible");
        bool=!bool
      }else{
        document.querySelector("#ic").classList.replace("fa-times", "fa-bars");
        document.querySelector(".sidebar").classList.replace("visible","hidden");
        bool=!bool
      }
    });
  </script>
</html>