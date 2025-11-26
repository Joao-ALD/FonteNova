import time
import random
import sys
from datetime import datetime

# Cores para deixar o terminal bonito (ANSI escape codes)
GREEN = '\033[92m'
YELLOW = '\033[93m'
RED = '\033[91m'
CYAN = '\033[96m'
RESET = '\033[0m'

verbs = ["Compiling", "Injecting", "Parsing", "Optimizing", "Verifying", "Encrypting", "Fetching", "Handshaking"]
nouns = ["dependency tree", "API headers", "SQL buffer", "daemon process", "memory heap", "checksum", "middleware", "SSL certificate"]
status_msg = ["OK", "CACHED", "SUCCESS", "UPDATED"]

print(f"{CYAN}Initializing environment variables...{RESET}")
time.sleep(1)
print(f"{CYAN}Connecting to remote cluster (us-east-1)...{RESET}")
time.sleep(1.5)
print(f"{GREEN}Connection established.{RESET}")
time.sleep(0.5)

try:
    while True:
        # Gera timestamp atual
        now = datetime.now().strftime("%H:%M:%S.%f")[:-3]
        
        verb = random.choice(verbs)
        noun = random.choice(nouns)
        
        # 10% de chance de mostrar um "Warning" (amarelo) para parecer real
        if random.random() < 0.1:
            print(f"[{now}] {YELLOW}[WARN]{RESET} High latency detected in {noun}, retrying...")
            time.sleep(random.uniform(0.5, 1.5))
            print(f"[{now}] {GREEN}[INFO]{RESET} Retry successful.")
        
        # 90% de chance de ser fluxo normal (verde/ciano)
        else:
            status = random.choice(status_msg)
            # Simula tamanhos de arquivos variados
            size = random.randint(12, 4500) 
            print(f"[{now}] {GREEN}[INFO]{RESET} {verb} {noun} modules... \t({size}ms) -> {GREEN}{status}{RESET}")

        # Velocidade variada para parecer processamento real
        time.sleep(random.uniform(0.05, 0.4))

except KeyboardInterrupt:
    print(f"\n{RED}[STOP] Process terminated by user.{RESET}")