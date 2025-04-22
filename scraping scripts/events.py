import re

# Load the file
with open("Events.txt", "r", encoding="utf-8") as f:
    lines = [line.strip() for line in f if line.strip()]

events = []
current_decade = None
current_category = None
current_event = {}

for line in lines:
    # Check for new decade header
    if re.match(r"^\d{4}s$", line):
        current_decade = line
        continue

    # Check for category header
    if line in ["Social Events", "Scientific Sources", "Legal Sources"]:
        current_category = line
        continue

    # New event starts with a year, optionally a date or range
    if re.match(r"^\d{4}(?:\s*-\s*\d{4})?", line):
        if current_event:
            events.append(current_event)
        current_event = {
            "decade": current_decade,
            "category": current_category,
            "year": line,
            "title": "",
            "description": "",
            "links": []
        }
        continue

    # If line has a title and colon (typical title + link line)
    if "Overview:" in line or "Facts of the Case:" in line or "Book:" in line or "Article:" in line:
        current_event["description"] += line + "\n"
        urls = re.findall(r'https?://\S+', line)
        current_event["links"].extend(urls)
    elif line.startswith("Photos:") or line.startswith("Source") or "http" in line:
        urls = re.findall(r'https?://\S+', line)
        current_event["links"].extend(urls)
    elif not current_event["title"]:
        current_event["title"] = line
    else:
        current_event["description"] += line + "\n"

# Don't forget the last event
if current_event:
    events.append(current_event)

# Display result
for e in events:
    print(f"{e['decade']} | {e['category']} | {e['year']} | {e['title']}")
    print(f"Description: {e['description'].strip()}")
    print(f"Links: {', '.join(e['links'])}\n")


import pandas as pd
df = pd.DataFrame(events)
df.to_csv("parsed_events.csv", index=False)
