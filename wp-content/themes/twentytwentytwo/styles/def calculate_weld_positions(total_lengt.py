def calculate_weld_positions(total_length, weld_length=1.5, space_length=3.5):
    welds = []
    current_position = 0
    
    while current_position + weld_length <= total_length:
        welds.append((current_position, current_position + weld_length))
        current_position += weld_length + space_length
    
    return welds

# Exemple d'utilisation
total_length = 40  # Par exemple, une longueur totale de 20 pouces
welds = calculate_weld_positions(total_length)

# Afficher les positions des soudures
for i, (start, end) in enumerate(welds, 1):
    print(f"Soudure {i}: de {start} pouces à {end} pouces")