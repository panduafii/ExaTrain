// Import Groq SDK
import Groq from "groq-sdk";

// Inisialisasi Groq dengan API key
const groq = new Groq({ apiKey: process.env.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 });

// Fungsi async untuk menjalankan program utama
export async function main() {
    try {
        // Panggil fungsi untuk mendapatkan jawaban dari AI Groq
        const chatCompletion = await getGroqChatCompletion();
        // Cetak jawaban yang diberikan oleh AI
        console.log(chatCompletion.choices[0]?.message?.content || "");
    } catch (error) {
        console.error("Error:", error);
    }
}

// Fungsi async untuk meminta AI Groq untuk memberikan jawaban
export async function getGroqChatCompletion() {
    // Gunakan Groq SDK untuk membuat permintaan chat completion
    return groq.chat.completions.create({
        messages: [
            {
                role: "user",
                content: "Jelaskan pentingnya model bahasa yang cepat",
            },
        ],
        model: "llama3-8b-8192",  // Model yang digunakan (llama3-8b-8192 adalah contoh model)
    });
}

// Panggil fungsi main untuk menjalankan program utama
main().catch(console.error);
