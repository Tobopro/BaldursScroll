import requests
from sys import argv
import json

info = ["name", "desc", "range", "ritual", "duration", "level", "attack_type", "damage"]
enddata = {}

def main():
    url = f"https://www.dnd5eapi.co/api/spells/{argv[1]}"
    # print("Url : ", url)
    headers = {'Accept': 'application/json'}

    response = requests.get(url, headers=headers)
    # print("Response : ", response)

    if response.status_code == 200:
        spells_data = response.json()

        for data in spells_data:
            if data in info:
                # print(f"{data} : {spells_data[data]}")
                enddata[data] = spells_data[data]
        
        print(json.dumps(enddata))

main()