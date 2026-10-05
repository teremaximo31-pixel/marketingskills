# equipe-rene

Plugin do Claude Code com a equipe de agentes da mentoria de René Cecconello (Posicionamento → Autoridade → Legado).

## O que vem nesta versão (Fase 1)

| Peça | Tipo | O que faz |
|---|---|---|
| `cerebro-rene` | Skill | Contexto comum: voz, metodologia, persona e regras de evidência. Todos os agentes leem antes de trabalhar |
| `gestor-de-trafego` | Agente | Lê a conta do Meta (`1287110245191448`), compara anúncios e públicos, calcula o funil depois do lead e recomenda. Só altera a conta com aprovação |
| `minerador-de-call` | Agente | Extrai conteúdo de calls de mentoria, sempre anonimizado |
| `social-media-rene` | Agente | Pauta semanal e roteiros na voz do René, com checklist de revisão |
| `/segunda-do-trafego` | Comando | Leitura semanal da conta |
| `/call-para-conteudo` | Comando | Call → ideias → roteiros |

## Instalação

No Claude Code (aplicativo, aba Code, ou terminal):

```
/plugin marketplace add teremaximo31-pixel/marketingskills
/plugin install equipe-rene@marketingskills
```

Depois, reinicie o Claude Code.

## Requisitos

- Conector do **Meta Ads** ligado na conta do claude.ai (para o gestor de tráfego).
- Opcional: conector do **Metricool** (para agendar posts) e do **Notion**.

## Antes de usar para valer

Preencha `skills/cerebro-rene/references/trajetoria-e-historias.md`: trajetória, histórias e depoimentos. Sem isso, os agentes deixam espaços marcados em vez de inventar, e o conteúdo perde a principal prova: a experiência do René.

## Próximas fases

- **Fase 2:** copywriter, web designer e vendas (roteiro de call de venda).
- **Fase 3:** arquiteto de infoproduto, frameworks de liderança e psicometrista.
- **Fase 4:** lançamentos, operações e ideias de SaaS.
