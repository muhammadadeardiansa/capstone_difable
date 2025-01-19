@extends('layout')

@section('content')
<h1>Kuis: {{ $subject->name }}</h1>
<div id="question-container">
    <h2 id="question">Klik tombol untuk memulai kuis!</h2>
    <div id="options" class="d-flex flex-wrap justify-content-center"></div>
    <p id="feedback" class="mt-3"></p>
    <button id="generate-question" class="btn btn-primary mt-3">Generate Soal</button>
</div>

<script>
    // Data soal dari server
    const questions = @json($subject->questions);

    // Elemen DOM
    const questionContainer = document.getElementById("question");
    const optionsContainer = document.getElementById("options");
    const feedbackContainer = document.getElementById("feedback");
    const generateButton = document.getElementById("generate-question");

    // Fungsi TTS (Text-to-Speech)
    function playTTS(text) {
        text = text.replace(/-/g, " dikurangi ");
        text = text.replace(/\+/g, " ditambah ");
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = "id-ID"; // Bahasa Indonesia
        utterance.pitch = 1.5; // Nada lebih tinggi
        utterance.rate = 1.2; // Kecepatan sedang
        utterance.volume = 1.0; // Volume penuh
        window.speechSynthesis.speak(utterance);
    }

    // Fungsi Generate Soal
    generateButton.addEventListener("click", () => {
        if (questions.length === 0) {
            questionContainer.textContent = "Tidak ada soal tersedia!";
            optionsContainer.innerHTML = "";
            feedbackContainer.textContent = "Harap periksa data JSON Anda.";
            return;
        }

        // Pilih soal acak
        const randomIndex = Math.floor(Math.random() * questions.length);
        const question = questions[randomIndex];

        // Tampilkan pertanyaan
        questionContainer.textContent = question.question;

        playTTS(question.question); // Putar suara pertanyaan

        // Kosongkan opsi jawaban
        optionsContainer.innerHTML = "";
        feedbackContainer.textContent = "";

        console.log(question);

        // Loop opsi jawaban
        question.options.forEach((option) => {
            const button = document.createElement("button");
            button.textContent = option;
            button.classList.add("btn", "btn-secondary", "m-2");
            button.onclick = () => {
                const userAnswer = option.trim(); // Hapus spasi tambahan
                const correctAnswer = question.answer.trim(); // Hapus spasi tambahan

                feedbackContainer.textContent =
                    userAnswer === correctAnswer ? "Benar!" : "Salah, coba lagi!";
                feedbackContainer.style.color =
                    userAnswer === correctAnswer ? "green" : "red";

                // TTS untuk hasil jawaban
                playTTS(
                    userAnswer === correctAnswer ?
                    "Jawaban Anda benar!" :
                    "Jawaban Anda salah, coba lagi!"
                );
            };

            optionsContainer.appendChild(button);
            console.log(option.answer);
        });

    });
</script>
@endsection