// CONFIGURAÇÃO PARA ANGOLA
// SUBSTITUA O NÚMERO ABAIXO SE PRECISAR
const SEU_NUMERO_WHATSAPP = "244951094079"; // Formato: 244 + número completo

// Máscara para telefone (formato Angola)
document.getElementById("telefone").addEventListener("input", function (e) {
  let value = e.target.value.replace(/\D/g, "");

  if (value.length > 0) {
    // Formato: +244 XXX XXX XXX
    if (value.startsWith("244")) {
      value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{3})/, "+$1 $2 $3 $4");
    } else {
      value = value.replace(/^(\d{3})(\d{3})(\d{3})/, "+244 $1 $2 $3");
    }
  }

  e.target.value = value;
});

// Envio do formulário
document
  .getElementById("whatsappForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    // Coletar dados do formulário
    const nome = document.getElementById("nome").value.trim();
    const telefone = document.getElementById("telefone").value.trim();
    const mensagem = document.getElementById("mensagem").value.trim();

    // Validação básica
    if (!nome || !telefone || !mensagem) {
      alert("Por favor, preencha todos os campos obrigatórios (*)");
      return;
    }

    // Formatar a mensagem para WhatsApp
    const dataAtual = new Date().toLocaleDateString("pt-PT");
    const horaAtual = new Date().toLocaleTimeString("pt-PT", {
      hour: "2-digit",
      minute: "2-digit",
    });

    const textoWhatsApp = `*Nova Mensagem do Portfólio*%0A%0A📅 *Data:* ${dataAtual}%0A⏰ *Hora:* ${horaAtual}%0A%0A👤 *Nome:* ${nome}%0A📧 📱 *Telefone:* ${telefone || "Não informado"}%0A%0A💬 *Mensagem:*%0A${mensagem}%0A%0A_Enviado através do site do portfólio_`;

    // Criar o link do WhatsApp
    const urlWhatsApp = `https://wa.me/${SEU_NUMERO_WHATSAPP}?text=${textoWhatsApp}`;

    // Abrir WhatsApp em nova aba
    window.open(urlWhatsApp, "_blank");

    // Feedback visual
    const botao = document.querySelector(".btn-whatsapp");
    const textoOriginal = botao.innerHTML;

    botao.innerHTML = '<i class="fas fa-check"></i> WHATSAPP ABERTO!';
    botao.style.backgroundColor = "#128C7E";

    setTimeout(() => {
      botao.innerHTML = textoOriginal;
      botao.style.backgroundColor = "#25D366";
    }, 3000);
  });

// Instruções no console
console.log("=== CONFIGURAÇÃO PARA ANGOLA ===");
console.log("Número configurado: +244 951 094 079");
console.log("No código: 244951094079");
console.log("Formato WhatsApp: https://wa.me/244951094079");
console.log("========================");