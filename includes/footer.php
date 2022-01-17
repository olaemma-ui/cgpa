<!-- <div class="w-full bg-darker fixed bottom-0 p-2 text-white text-center border-t-dark">
  Developed by Olaemma
</div> -->
</body>
  <script>
    var bool = true;
    var id = "";
    document.querySelector("#btn").addEventListener("click", function () {
      document.querySelector("#btn").style.cssText = "border: none; background: rgba(30, 64, 175, var(--tw-bg-opacity);";
      if (bool) {
        document.querySelector(".sidebar").classList.replace("left", "right");
        document.querySelector("#ic").classList.replace("fa-bars", "fa-times");
        document.querySelector(".sidebar").classList.replace("invisible", "visible");
        bool=!bool
      }else{
        document.querySelector("#ic").classList.replace("fa-times", "fa-bars");
        document.querySelector(".sidebar").classList.replace("visible","invisible");
        bool=!bool
      }
    });
    document.querySelector("#add").addEventListener("click", function () {
      document.querySelector("#table").classList.replace("visible", "invisible");
      document.querySelector("#form").classList.replace("invisible", "visible");
      document.querySelector("#view").classList.replace("bg-blue-700", "bg-white");
      document.querySelector("#add").classList.replace("bg-white", "bg-blue-700");
      document.querySelector("#add").classList.replace("text-black", "text-white");
      document.querySelector("#view").classList.replace("text-white", "text-black");
      document.querySelector("#table").classList.add("absolute");
      document.querySelector("#lev-btn").classList.add("invisible");
    });
    document.querySelector("#view").addEventListener("click", function () {
      document.querySelector("#form").classList.replace("visible", "invisible");
      document.querySelector("#table").classList.replace("invisible", "visible");
      document.querySelector("#view").classList.replace("bg-white", "bg-blue-700");
      document.querySelector("#add").classList.replace("bg-blue-700", "bg-white");
      document.querySelector("#view").classList.replace("text-black", "text-white");
      document.querySelector("#add").classList.replace("text-white", "text-black");
      document.querySelector("#table").classList.remove("absolute");
      document.querySelector("#lev-btn").classList.remove("invisible");
    });
  </script>
</html>