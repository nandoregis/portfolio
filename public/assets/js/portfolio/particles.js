class Particle {
    
  constructor(effect) {
    this.effect = effect;
    this.reset();
  }

  reset() {
    this.x = Math.random() * this.effect.width;
    this.y = Math.random() * this.effect.height;
    this.size = Math.random() * 2 + 1;
    this.speedX = (Math.random() - 0.5) * 1.2;
    this.speedY = (Math.random() - 0.5) * 1.2;
    this.opacity = Math.random() * 0.5 + 0.3;
  }

  update() {
    this.x += this.speedX;
    this.y += this.speedY;

    // Se sair da tela, reseta
    if (
      this.x < 0 ||
      this.x > this.effect.width ||
      this.y < 0 ||
      this.y > this.effect.height
    ) {
      this.reset();
    }
  }

  draw(ctx) {
    ctx.beginPath();
    ctx.fillStyle = `rgba(0, 255, 255, ${this.opacity})`;
    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
    ctx.fill();
  }
}

class ParticleEffect {
  constructor(canvas) {
    this.canvas = canvas;
    this.ctx = canvas.getContext("2d");
    this.particles = [];
    this.particleCount = 120;

    this.resize();
    window.addEventListener("resize", () => this.resize());

    this.init();
    this.animate();
  }

  resize() {
    const parent = this.canvas.parentElement;

    this.width = parent.clientWidth;
    this.height = parent.clientHeight;

    this.canvas.width = this.width;
    this.canvas.height = this.height;
  }

  init() {
    this.particles = [];
    for (let i = 0; i < this.particleCount; i++) {
      this.particles.push(new Particle(this));
    }
  }

  connectParticles() {
    for (let a = 0; a < this.particles.length; a++) {
      for (let b = a; b < this.particles.length; b++) {
        const dx = this.particles[a].x - this.particles[b].x;
        const dy = this.particles[a].y - this.particles[b].y;
        const distance = dx * dx + dy * dy;

        if (distance < 12000) {
          this.ctx.beginPath();
          this.ctx.strokeStyle = "rgba(0,255,255,0.1)";
          this.ctx.lineWidth = 0.5;
          this.ctx.moveTo(this.particles[a].x, this.particles[a].y);
          this.ctx.lineTo(this.particles[b].x, this.particles[b].y);
          this.ctx.stroke();
        }
      }
    }
  }

  animate() {
    this.ctx.clearRect(0, 0, this.width, this.height);

    this.particles.forEach((particle) => {
      particle.update();
      particle.draw(this.ctx);
    });

    this.connectParticles();

    requestAnimationFrame(() => this.animate());
  }
}

// Inicialização
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("particles-canvas");
  new ParticleEffect(canvas);
});