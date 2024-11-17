import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';  // Importando o plugin Vue
import path from 'path';

// https://vitejs.dev/config/
export default defineConfig({
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources'),
    },
  },
  plugins: [
    vue(),
  ], // Usando o plugin Vue
  build: {
    outDir: 'public/build',  // Configuração do diretório de build
  },
  server: {
    proxy: {
      '/app': 'http://localhost',  // Proxy para o Laravel durante o desenvolvimento
    },
  },
  optimizeDeps: {
    include: ['vue']  // Certifique-se de que o Vue está sendo incluído nas dependências do Vite
  }
});
