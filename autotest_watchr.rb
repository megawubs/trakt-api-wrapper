def notify title, msg, img, show_time
  images_dir='~/.autotest/images'
  system "notify-send '#{title}' '#{msg}' -i #{images_dir}/#{img} -t #{show_time}"
end

def run_test(file)
  unless File.exist?(file)
    puts "#{file} does not exist"
    return
  end
 
  puts "Running #{file}"
  result = `phpunit #{file}`
  puts result
  if result.match(/OK/)
      notify "#{file}", "Tests Passed Successfuly", "success.png", 2000
    end
end

watch("test/.*Test.php") do |match|
  run_test match[0]
end

watch("src/(.*).php") do |match|
  run_test %{test/#{match[1]}Test.php}
end
