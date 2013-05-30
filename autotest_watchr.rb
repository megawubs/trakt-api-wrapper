def clear_console
  puts "\e[H\e[2J"  #clear console
end

def notify title, msg
  system "growlnotify -n 'autotest' -m '#{title}' '#{msg}' "
end

def notify_failed cmd, result
  failed_examples = result.scan(/failure:\n\n(.*)\n/)
  errors = result[/.*errors/]
  notify "#{cmd}", "'#{errors}.'"
end

def run_test(file)
  clear_console
  unless File.exist?(file)
    puts "#{file} does not exist"
    return
  end
 
  puts "Running #{file}"
  result = `phpunit #{file}`
  puts result
  if result.match(/OK/)
      num = result[/\((.*)\s(.*),\s(.*).\s(.*)\)/]
      notify "#{file}", "Tests Passed Successfuly #{num}"
  elsif result.match(/FAILURES\!/)
    notify_failed file, result
    end
end

watch("tests/.*Test.php") do |match|
  run_test match[0]
end

watch("src/(.*).php") do |match|
  run_test %{tests/#{match[1]}Test.php}
end
