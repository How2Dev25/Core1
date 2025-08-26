<!-- Captcha verification box -->
<div class="mb-6">
  <div class="bg-white/10 border border-white/20 rounded-lg p-4 backdrop-blur-sm hover:bg-white/15 transition-all duration-300">
    <div class="flex items-center gap-4">
      <div 
        id="captcha-check" 
        class="relative w-6 h-6 border-2 border-white/40 rounded cursor-pointer bg-white/5 hover:border-white/60 transition-all duration-300 flex items-center justify-center group"
        role="checkbox"
        aria-checked="false"
        tabindex="0"
      >
        <!-- Checkmark -->
        <svg 
          class="w-4 h-4 text-[#F7B32B] opacity-0 scale-0 transition-all duration-300 ease-out" 
          id="checkmark"
          fill="currentColor" 
          viewBox="0 0 20 20"
        >
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
        
        <!-- Spinner -->
        <div 
          class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300"
          id="checkbox-spinner"
        >
          <div class="animate-spin rounded-full h-4 w-4 border-2 border-white/30 border-t-[#F7B32B]"></div>
        </div>
      </div>
      
      <div class="flex-1">
        <span class="text-white/90 text-sm font-medium">Captcha</span>
      </div>
    </div>
  </div>

  <!-- Loading spinner -->
  <div id="captcha-loading" class="mt-3 hidden">
    <div class="flex items-center gap-3 text-white/90 text-sm">
      <div class="animate-spin rounded-full h-4 w-4 border-2 border-white/30 border-t-[#F7B32B]"></div>
      <span>Generating captcha...</span>
    </div>
  </div>

  <!-- Math captcha -->
  <div id="captcha-container" class="mt-3 hidden transform transition-all duration-500 ease-out opacity-0 translate-y-2">
    <div class="bg-white/5 border border-white/20 rounded-lg p-4 backdrop-blur-sm">
      <div class="flex items-center justify-between mb-3">
        <label class="block text-white/90 text-sm font-medium">
          Captcha: What is <span id="captcha-question" class="text-[#F7B32B] font-bold text-base">?</span>
        </label>
        <button 
          id="refresh-captcha" 
          type="button" 
          class="text-xs text-white/70 hover:text-[#F7B32B] transition"
          title="Refresh captcha"
        >
          ⟳
        </button>
      </div>

      <!-- Instead of input, use a div with choices -->
      <div id="captcha-options" class="flex gap-3"></div>

      <!-- Success indicator -->
      <div id="captcha-success" class="mt-2 hidden">
        <div class="flex items-center gap-2 text-green-400 text-sm">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
          </svg>
          <span>Correct!</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Submit Button -->


<script>
  document.addEventListener("DOMContentLoaded", function() {
    const checkboxDiv = document.getElementById("captcha-check");
    const checkmark = document.getElementById("checkmark");
    const checkboxSpinner = document.getElementById("checkbox-spinner");
    const loadingDiv = document.getElementById("captcha-loading");
    const container = document.getElementById("captcha-container");
    const question = document.getElementById("captcha-question");
    const optionsDiv = document.getElementById("captcha-options");
    const successDiv = document.getElementById("captcha-success");
    const loginBtn = document.getElementById("login-btn");
    const refreshBtn = document.getElementById("refresh-captcha");

    let isChecked = false;
    let expectedAnswer = null;

    function setSubmitState(enabled) {
      loginBtn.disabled = !enabled;
      if (enabled) {
        loginBtn.classList.remove("opacity-50", "cursor-not-allowed");
      } else {
        loginBtn.classList.add("opacity-50", "cursor-not-allowed");
      }
    }

    function generateCaptcha() {
      successDiv.classList.add("hidden");
      setSubmitState(false);

      let a = Math.floor(Math.random() * 9) + 1;
      let b = Math.floor(Math.random() * 9) + 1;
      let ops = ['+', '-', '×'];
      let op = ops[Math.floor(Math.random() * ops.length)];
      
      switch (op) {
        case '+': expectedAnswer = a + b; break;
        case '-': expectedAnswer = a - b; break;
        case '×': expectedAnswer = a * b; break;
      }

      question.textContent = `${a} ${op} ${b}`;
      optionsDiv.innerHTML = "";

      // Generate multiple-choice answers
      let answers = new Set([expectedAnswer]);
      while (answers.size < 3) {
        answers.add(Math.floor(Math.random() * 20));
      }

      [...answers].sort(() => Math.random() - 0.5).forEach(ans => {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.textContent = ans;
        btn.className = "px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white hover:bg-[#F7B32B]/30 transition";
        
        btn.addEventListener("click", () => {
          if (ans === expectedAnswer) {
            successDiv.classList.remove("hidden");
            setSubmitState(true);
          } else {
            successDiv.classList.add("hidden");
            setSubmitState(false);
          }
        });

        optionsDiv.appendChild(btn);
      });
    }

    function showCaptcha() {
      loadingDiv.classList.remove("hidden");
      setTimeout(() => {
        generateCaptcha();
        loadingDiv.classList.add("hidden");
        container.classList.remove("hidden");
        container.classList.add("opacity-100", "translate-y-0");
      }, 1200);
    }

    checkboxDiv.addEventListener("click", function() {
      if (!isChecked) {
        checkboxSpinner.style.opacity = '1';
        setTimeout(() => {
          checkboxSpinner.style.opacity = '0';
          checkmark.style.opacity = '1';
          checkmark.style.transform = 'scale(1)';
          isChecked = true;
          setTimeout(showCaptcha, 500);
        }, 1500);
      } else {
        checkmark.style.opacity = '0';
        checkmark.style.transform = 'scale(0)';
        isChecked = false;
        container.classList.add("hidden");
        setSubmitState(false);
      }
    });

    refreshBtn.addEventListener("click", function() {
      generateCaptcha();
    });

    // Initial state: submit disabled
    setSubmitState(false);
  });
</script>